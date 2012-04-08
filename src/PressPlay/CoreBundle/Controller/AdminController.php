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
use PressPlay\CoreBundle\Entity\WorkMonth;
use PressPlay\CoreBundle\Form\WorkMonthType;

class AdminController extends Controller
{

    /**
     * @Route("/admin/", name="admin_home")
     * @Template()
     */      
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $create_user_form = $this->container->get('fos_user.registration.form');
        
        $userManager = $this->container->get('fos_user.user_manager');
        
        $users = $userManager->findUsers();
        
        $workmonths = $em->getRepository('PressPlayCoreBundle:WorkMonth')->findAll();        
        
        return array(
            'create_user_form' => $create_user_form->createView(),
            'workmonths' => $workmonths,
            'users' => $users,
        );
    }  
}
