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
        
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        $timesheet = $em->getRepository('PressPlayCoreBundle:TimeSheet')->findOneTimeSheetByDateAndUser($date, $user);        

        if($timesheet == null){
            $timesheet = new TimeSheet();
            $timesheet->setUser($user);
            $timesheet->setDate($date);
            $em->persist($timesheet);
            $em->flush();                         
        }
        
        $today = new DateTime();
        $yesterday = strtotime($date->format('Ymd').' -1 day');
        
        $entity = new TimeTracking();
        $form   = $this->createForm(new TimeTrackingType(), $entity);
        
        return array(
            'timesheet' => $timesheet,
            'date' => $date,
            'today' => $today,
            'yesterday' => $yesterday,
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }
}
