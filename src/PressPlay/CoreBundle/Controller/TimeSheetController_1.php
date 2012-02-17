<?php

namespace PressPlay\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PressPlay\CoreBundle\Entity\TimeTracking;
use PressPlay\CoreBundle\Entity\TimeSheet;
use Symfony\Component\HttpFoundation\Response;

/**
 * TimeSheet controller.
 *
 * @Route("/timesheet")
 */
class TimeSheetController extends Controller
{

    /**
     * Handles submitting a TimeSheet
     *
     * @Route("/{id}/update", name="timesheet_submit")
     * @Method("post")
     */
    public function submitAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $timesheet = $em->getRepository('PressPlayCoreBundle:TimeSheet')->find($id);  
        
        if (!$timesheet) {
            throw $this->createNotFoundException('Unable to find TimeSheet entity.');
        }        
        
        $date = $timesheet->getDate();
        
        $request = $this->getRequest();
        
        $ids = $request->get("timetrack_id");
        $startTimes = $request->get("startTime");
        $stopTimes = $request->get("stopTime");
        $adjustments = $request->get("adjustment");

        $intervals = array();
        
        for ($i = 0; $i < count($ids); $i++){
            $intervals[$i] = array();
            $intervals[$i]['id'] = $ids[$i];
            $intervals[$i]['start'] = $startTimes[$i];
            $intervals[$i]['stop'] = $stopTimes[$i];
            $intervals[$i]['adjustment'] = $adjustments[$i];
            
        }
        
        
        // We begin to validate the entries
        $errors = array();
        if($this->validate_interval_overlap($intervals)){
            $errors[] = "Intervals are not overlapping";
        }else{
            $errors[] = "Intervals are overlapping";
        }
        
        if(!$this->validate_time_formats($intervals)){
            $errors[] = "Intervals has wrong time format";
        }else{
            $errors[] = "Intervals has validated time format";
        }
        
        return new Response(var_dump($errors, $date, $intervals, $request));
    }
    
    private function validate_time_formats($intervals){
        for ($i = 0; $i < count($intervals); $i++){
            $start = $intervals[$i]['start'];;
            $stop = $intervals[$i]['stop'];
            
            if(!$this->is_valid_time_format($start) || !$this->is_valid_time_format($stop) ||  !$this->is_valid_time_format($adjustment)){
                return false;
            }
        }   
        
        return true;
    }
    
    private function validate_interval_overlap($intervals){
        if(count($intervals) <= 1){
            return true;
        }
        
        for ($i = 0; $i < count($intervals); $i++){
            for ($k = 0; $k < count($intervals); $k++){
                if($i == $k){
                    continue;
                }
                
                if(!$this->is_time_outside_interval($intervals[$k]['start'], $intervals[$i]['start'], $intervals[$i]['stop'])){
                    return false;
                }else if(!$this->is_time_outside_interval($intervals[$k]['stop'], $intervals[$i]['start'], $intervals[$i]['stop'])){
                    return false;
                }
            }            
        }
        
        return true;
    }
    
    private function is_valid_time_format($time){
        return (bool)preg_match("/^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/", $time);
    }
    
    private function is_time_outside_interval($time, $start, $stop){
       $time = explode(":", $time);
       $start = explode(":", $start);
       $stop = explode(":", $stop);
       
       return ($time[0] < $start[0] 
            || $time[0] > $stop[0] 
            || ($time[0] == $start[0] && $time[1] < $start[1])
            || ($time[0] == $stop[0] && $time[1] > $stop[1]));        
    }
}
