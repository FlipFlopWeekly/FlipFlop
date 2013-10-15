<?php

namespace FlipFlop\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FlipFlopNewsletterBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * Static template of the newsletter.
     */
    public function templatingaction()
    {
        $parameters = array();
        $parameters['crew_name'] = $this->container->parameters['crew_name'];

        return $this->render('FlipFlopNewsletterBundle:Default:template.html.twig', array('parameters' => $parameters));
    }
}
