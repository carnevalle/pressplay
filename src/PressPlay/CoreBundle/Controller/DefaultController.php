<?php

namespace PressPlay\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use \DateTime;
use PressPlay\CoreBundle\Entity\TimeTracking;
use PressPlay\CoreBundle\Form\TimeTrackingType;
use PressPlay\CoreBundle\Form\TimeSheetType;
use PressPlay\CoreBundle\Entity\TimeSheet;

class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {

        $securityContext = $this->get('security.context');
        $token = $securityContext->getToken();
        $user = $token->getUser();
        
        if(!is_string($user)){
            $url = $this->container->get('router')->generate("dashboard_home");
            return new RedirectResponse($url);            
        }
        
        
        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return array(
            'csrf_token' => $csrfToken,
        );
    }
    
    /**
     * @Route("/dashboard/{date}", defaults={"date" = "now"}, name="dashboard_home")
     * @Template()
     */    
    public function dashboardAction($date){

        if($date == "now"){
            $date = new DateTime();
            
        }else{
            $date = DateTime::createFromFormat('Ymd', $date);    
        }
        $today = new DateTime();

        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();

        $workmonthemployee = $em->getRepository('PressPlayCoreBundle:WorkMonthEmployee')->findByDateAndUser($date,$user);
        $latestWorkMonth = null;

        // If no month for current date. Lets find the latest month then
        if (!$workmonthemployee) {
            $latestWorkMonth = $em->getRepository('PressPlayCoreBundle:WorkMonthEmployee')->findLatest($user);
        }

        if ($workmonthemployee) {
            $timesheet = $em->getRepository('PressPlayCoreBundle:TimeSheet')->findOneTimeSheetByDateAndUser($date, $user);        

            if($timesheet == null){
                $timesheet = new TimeSheet();
                $timesheet->setUser($user);
                $timesheet->setDate($date);
                $timesheet->setWorkmonth($workmonthemployee);
                $em->persist($timesheet);
                $em->flush();                         
            }

            $form = $this->createForm(new TimeSheetType(), $timesheet);

            return array(
                'hastimesheet' => true,
                'timesheet' => $timesheet,
                'selectedworkmonth' => $workmonthemployee,
                'today' => $today,
                'user' => $user,
                'form' => $form->createView(),
                'date' => $date,
            );            
        }

        return array(
            'hastimesheet' => false,
            'today' => $today,
            'user' => $user,
            'date' => $date,
        );  
    }
}
