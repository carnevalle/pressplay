<?php

namespace PressPlay\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
     * @Route("/dashboard/", name="dashboard_home")
     * @Template()
     */    
    public function dashboardAction(){
        return array('name' => "Troels");
    }
}
