<?php

namespace FlipFlop\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FlipFlopAuthBundle:Default:index.html.twig', array('name' => $name));
    }
}
