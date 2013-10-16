<?php

namespace FlipFlop\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServiceController extends Controller
{
    /**
     * Get parameters used in the newsletter.
     *
     * @return multitype:NULL
     */
    public function getParameters()
    {
        $parameters = array();
        $parameters['crew_name'] = $this->container->parameters['crew_name'];

        return $parameters;
    }

    /**
     * Get newsletter template "Path"
     *
     * @return string
     */
    public function getTemplateName()
    {
        return 'FlipFlopNewsletterBundle:Pages:template.html.twig';
    }

    /**
     * Static template of the newsletter.
     *
     * @return unknown_type
     */
    public function templatingaction()
    {
        $parameters = $this->getParameters();

        return $this->render( $this->getTemplateName(), array( 'parameters' => $parameters ) );
    }
}
