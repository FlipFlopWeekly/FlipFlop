<?php

namespace FlipFlop\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    // First commit test
    public function welcomeAction($name)
    {
        return $this->render('FlipFlopSiteBundle:Default:index.html.twig', array('name' => $name));
    }

    public function indexAction()
    {
        return $this->render('FlipFlopSiteBundle:Default:home.html.twig');
    }
}
