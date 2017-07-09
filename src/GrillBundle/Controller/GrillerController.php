<?php

namespace GrillBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GrillBundle\Entity\Griller;
use GrillBundle\Form\GrillerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

class GrillerController extends Controller
{
        public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $grillActive = $this->getDoctrine()->getRepository('GrillBundle:Grill')->findOneBy(array('isActive' => true));
        $grillers = $this->getDoctrine()->getRepository('GrillBundle:Griller')->findBy(array('grill' => $grillActive));
        return $this->render('GrillBundle:Griller:index.html.twig',array('grillers' => $grillers, 'grill' => $grillActive));
    }
    
    /**
     * @Route("/edit")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $griller = $this->getDoctrine()->getRepository('GrillBundle:Griller')->find($id);
        $griller->setPhoto( new File($this->getParameter('photos_directory').'/'.$griller->getPhoto()));
        $form = $this->createEditForm($griller);
        
        return $this->render('GrillBundle:Griller:edit.html.twig', array('form' => $form->createView()));
        
    }
    
    private function createEditForm(Griller $entity)
    {
                                  
        $form = $this->createForm(GrillerType::class, $entity,array('action' => $this->generateUrl('griller_update', array('id' => $entity->getid(), 'method' => 'PUT'))));
        
        return $form;
    }
    
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $griller = $this->getDoctrine()->getRepository('GrillBundle:Griller')->find($id);
        
        $form = $this->createEditForm($griller);
        $form->handleRequest($request);
        
        
        if($form->isSubmitted() && $form->isValid())
        {
            // $file stores the uploaded JPG or PNG file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $griller->getPhoto();

            // Generate a unique name for the file before saving it
            //$fileName = md5(uniqid()).'.'.$file->guessExtension();
            $fileName = $griller->getGrill()->getid().'-'.$griller->getid().'.'.$file->guessExtension();
    
            // Move the file to the directory where photos are stored
            $file->move(
                $this->getParameter('photos_directory'),
                $fileName
            );

            // Update the 'photo' property to store the file name
            // instead of its contents
            $griller->setPhoto($fileName);
            
            $em->persist($griller);
            $em->flush();
            $successMessage = 'The griller has been modified.';
            $this->addFlash('mensaje', $successMessage);
            return $this->redirectToRoute('griller_index');
        }
        return $this->render('GrillBundle:Griller:edit.html.twig', array('griller' => $griller, 'form' => $form->createView()));
        //return new Symfony\Component\HttpFoundation\Response("Error");
    }

    public function restartAction(){
        $em = $this->getDoctrine()->getManager();
        $grillActive = $this->getDoctrine()->getRepository('GrillBundle:Grill')->findOneBy(array('isActive' => true));
        $grillers = $this->getDoctrine()->getRepository('GrillBundle:Griller')->findBy(array('grill' => $grillActive));
        //$file = New File($this->getParameter('photos_directory')."/test.jpg",true);
        foreach ($grillers as $griller)
        {
            $em->remove($griller);
            $em->flush();
        }
        for ($i = 1; $i <= 100; $i++) {
            $griller = new Griller();
            $griller->setName("");
            $griller->setGrill($grillActive);
            $griller->setPhoto("defaultPhoto.jpg");
            $griller->setDescription("");
            $griller->setEmail("");
            $em->persist($griller);
            $em->flush();
        }
        return $this->redirectToRoute('griller_index');
    }
    
/*    public Function addPhotoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $griller = $this->getDoctrine()->getRepository('GrillBundle:Griller')->find($id);
        $form = $this->createAddPhotoForm($griller);
        
        return $this->render('GrillBundle:Griller:addPhoto.html.twig', array('form' => $form->createView()));
    }
    
    private function createAddPhotoForm(Griller $entity)
    {
                                  
        $form = $this->createForm(GrillerType::class, $entity,array('action' => $this->generateUrl('griller_createphoto', array('id' => $entity->getid(), 'method' => 'PUT', 'is_add_photo_form' => true ))));
        
        return $form;
    }*/
}
