<?php

namespace RaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RaceController extends Controller
{
    public function indexAction()
    {
        return $this->render('RaceBundle:Default:index.html.twig');
    }
}
