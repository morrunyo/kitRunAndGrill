<?php

namespace RaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RaceBundle\Entity\Race;
use RaceBundle\Form\RaceType;
use Symfony\Component\HttpFoundation\Request;

class RaceController extends Controller
{ 
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        return $this->render('RaceBundle:Race:index.html.twig',$arrayName = array('races' => $races));
    }
    
    public function addAction()
    {
        $race = new Race();
        $form = $this->createCreateForm($race);

        return $this->render('RaceBundle:Race:add.html.twig', array('form' => $form->createView()));
    }
    
    public function createAction(Request $request)
    {
        $race = new Race();
        $form = $this->createCreateForm($race);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($race);
            $em->flush();
            
            return $this->redirectToRoute('race_index');
        }
        
        return $this->render('RaceBundle:Race:add.html.twig', array('form' => $form->createView())); 
    }
    
    private function createCreateForm(Race $entity)
    {
        $form = $this->createForm(RaceType::class, $entity, array('action' => $this->generateUrl('race_create'), 'method' => 'POST'));    
        return $form;
    }
    
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $race = $em->getRepository('RaceBundle:Race')->find($id);
        
        if(!$race)
        {
            $messageException = 'Race not found.';
            throw $this->createNotFoundException($messageException);
        }
        
        $form = $this->createEditForm($race);
        
        return $this->render('RaceBundle:Race:edit.html.twig', array('race' => $race, 'form' => $form->createView()));
        
    }
    
    private function createEditForm(Race $entity)
    {
        $form = $this->createForm(RaceType::class, $entity,array('action' => $this->generateUrl('race_update', array('id' => $entity->getId())), 'method' => 'PUT'));
        
        return $form;
    }
    
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $race = $em->getRepository('RaceBundle:Race')->find($id);
        if(!$race)
        {
            $messageException = 'Race not found.';
            throw $this->createNotFoundException($messageException);
        }
        
        $form = $this->createEditForm($race);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $successMessage = 'The race has been modified.';
            $this->addFlash('mensaje', $successMessage);
            return $this->redirectToRoute('race_index');
        }
        //return $this->render('RaceBundle:Race:edit.html.twig', array('race' => $race, 'form' => $form->createView()));
        return new Symfony\Component\HttpFoundation\Response("Error");
    }

    public function activateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        foreach ($races as $race)
        {
            if ($race->getId()==$id)
            {   
                $race->setIsActive(true);
            }
            else{
                $race->setIsActive(false);
            }
            $em->persist($race);
            $em->flush();
        }
        return $this->render('RaceBundle:Race:index.html.twig',$arrayName = array('races' => $races));
    }
    
    public function startAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $race = $this->getDoctrine()->getRepository('RaceBundle:Race')->findOneById($id);
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        if ($race==NULL)
        {
            $race = new Race();
            $race->setName("");
            $race->setIsActive(false);
            $race->setStartedAt(new \DateTime('now'));
            $em->persist($race);
            $em->flush();
        }
        else{
            $race->setStartedAt(new \DateTime('now'));
            $em->persist($race);
            $em->flush(); 
        }
        $races = $this->getDoctrine()->getRepository('RaceBundle:Race')->findAll();
        $this->activateAction($race->getId());
        return $this->render('RaceBundle:Race:index.html.twig',$arrayName = array('races' => $races));
    }
}
