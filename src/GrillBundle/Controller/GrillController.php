<?php

namespace GrillBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GrillController extends Controller
{
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('GrillBundle:Grill:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/activate")
     */
    public function activateAction()
    {
        return $this->render('GrillBundle:Grill:activate.html.twig', array(
            // ...
        ));
    }

}
