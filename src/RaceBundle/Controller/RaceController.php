<?php

namespace RaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RaceBundle\Entity\Race;

class RaceController extends Controller
{
    public function indexAction()
    {
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        return $this->render('RaceBundle:Race:index.html.twig',$arrayName = array('races' => $races));
    }
    
    public function activateAction($id)
    {
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        foreach ($races as $race)
        {
            if ($race->getIsActive())
            {
                $race->setIsActive(false);
            }
            if ($race->getId()==$id)
            {   
                $race->setIsActive(true);
            }
        }
        return $this->render('RaceBundle:Race:index.html.twig',$arrayName = array('races' => $races));
    }
}
