<?php

namespace FlipFlop\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    // First commit test
    public function welcomeAction($name)
    {
        return $this->render('FlipFlopSiteBundle:StaticPages:welcome.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
    	// If no user is connected redirect to login page
    	if (is_null($this->getUser())) {
    		return $this->redirect($this->generateUrl('flipflop_site_loginpage'));
    	}
    	
        return $this->render('FlipFlopSiteBundle:StaticPages:home.html.twig');
    }
}
