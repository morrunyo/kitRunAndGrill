<?php

namespace GrillBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GrillerController extends Controller
{
    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('GrillBundle:Griller:edit.html.twig', array(
            // ...
        ));
    }

}
