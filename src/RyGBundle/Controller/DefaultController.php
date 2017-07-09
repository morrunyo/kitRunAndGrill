<?php

namespace RyGBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RyGBundle:Default:index.html.twig');
    }
}
