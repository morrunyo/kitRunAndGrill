<?php

namespace CarreraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CarreraBundle:Default:index.html.twig');
    }
}
