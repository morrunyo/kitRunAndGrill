<?php

namespace RaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RaceBundle\Entity\Runner;
use RaceBundle\Form\RunnerType;
use Symfony\Component\HttpFoundation\Request;

class RunnerController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $raceActive = $this->getDoctrine()->getRepository('RaceBundle:Race')->findOneBy(array('isActive' => true));
        $runners = $this->getDoctrine()->getRepository('RaceBundle:Runner')->findBy(array('race' => $raceActive),array('finishedAt' => 'ASC'));
        return $this->render('RaceBundle:Runner:index.html.twig',$arrayName = array('runners' => $runners, 'race' => $raceActive));
    }
    
    
    
    public function editAction()
    {
        $runner = New Runner();
        $runner->setCode(0);
        $form = $this->createEditForm($runner);
        
        return $this->render('RaceBundle:Runner:edit.html.twig', array('form' => $form->createView()));
        
    }
    
    private function createEditForm(Runner $entity)
    {
                                  
        $form = $this->createForm(RunnerType::class, $entity,array('action' => $this->generateUrl('runner_update'), 'method' => 'PUT'));
        
        return $form;
    }
    
    public function updateAction(Request $request)
    {
        $runner = New Runner();
        $em = $this->getDoctrine()->getManager();
        //$runner = $this->getDoctrine()->getRepository('RaceBundle:Runner')->findOneBy(array('code' => $request->request->get('racebundle_race')->get('code')));
        
        $form = $this->createEditForm($runner);
        $form->handleRequest($request);
        
        
        if($form->isSubmitted() && $form->isValid())
        {
            $runner = $this->getDoctrine()->getRepository('RaceBundle:Runner')->findOneBy(array('code' => $form->get('code')->getData()));
            $runner->setName($form->get('name')->getData());
            $em->flush();
            $successMessage = 'The runer has been modified.';
            $this->addFlash('mensaje', $successMessage);
            return $this->redirectToRoute('runner_index');
        }
        return $this->render('RaceBundle:Race:edit.html.twig', array('race' => $race, 'form' => $form->createView()));
        //return new Symfony\Component\HttpFoundation\Response("Error");
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
