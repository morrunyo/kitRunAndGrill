<?php

namespace RaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RaceBundle\Entity\Race;

class RaceController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        return $this->render('RaceBundle:Race:index.html.twig',$arrayName = array('races' => $races));
    }
    
    public function activateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        foreach ($races as $race)
        {
            if ($race->getIsActive())
            {
                $race->setIsActive(false);
                $em->persist($race);
            }
            elseif ($race->getId()==$id)
            {   
                $race->setIsActive(true);
                $em->persist($race);
            }
            $em->flush();
        }
        return $this->render('RaceBundle:Race:index.html.twig',$arrayName = array('races' => $races));
    }
    
    public function startAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $race = $this->getDoctrine()->getRepository('RaceBundle:Race')->findOneById($id);
        if ($race==NULL)
        {
            $race = new Race();
            $race->setName("");
            $race->setIsActive(false);
        }
        $race->setStartedAt(new \DateTime('now'));
        $em->persist($race);
        $em->flush();
        $this->activateAction($race->getId());
        
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        return $this->render('RaceBundle:Race:index.html.twig',$arrayName = array('races' => $races));
    }
}
