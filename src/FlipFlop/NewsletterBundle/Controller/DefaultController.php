<?php

namespace FlipFlop\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Auto generated indexAction.
     *
     * @param unknown_type $name
     */
    public function indexAction($name)
    {
        return $this->render( 'FlipFlopNewsletterBundle:Default:index.html.twig', array( 'name' => $name ) );
    }
}
