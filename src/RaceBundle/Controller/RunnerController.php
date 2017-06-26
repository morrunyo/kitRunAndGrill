<?php

namespace RaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RaceBundle\Entity\Runner;

class RunnerController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $raceActive = $this->getDoctrine()->getRepository('RaceBundle:Race')->findOneBy(array('isActive' => true));
        $runners = $this->getDoctrine()->getRepository('RaceBundle:Runner')->findBy(array('race' => $raceActive),array('finishedAt' => 'ASC'));
        return $this->render('RaceBundle:Runner:index.html.twig',$arrayName = array('runners' => $runners, 'race' => $raceActive));
    }
    
    public function chronoAction($code)
    {
        $em = $this->getDoctrine()->getManager();
        $raceActive = $this->getDoctrine()->getRepository('RaceBundle:Race')->findOneBy(array('isActive' => true));
        $runner = $this->getDoctrine()->getRepository('RaceBundle:Runner')->findOneBy(array('race' => $raceActive, 'code' => $code));
        if ($runner)
        {
            $runner->setFinishedAt(new \DateTime('now'));
            $em->persist($runner);
            $em->flush();
        }
        else
        {
            $runner = new Runner();
            $runner->setCode($code);
            $runner->setRace($raceActive);
            $runner->setName("");
            $runner->setFinishedAt(new \DateTime('now'));
            $em->persist($runner);
            $em->flush();            
        }
        $runners = $this->getDoctrine()->getRepository('RaceBundle:Runner')->findBy(array('race' => $raceActive),array('finishedAt' => 'ASC'));
        return $this->render('RaceBundle:Runner:index.html.twig',$arrayName = array('runners' => $runners, 'race' => $raceActive));
    }
}
