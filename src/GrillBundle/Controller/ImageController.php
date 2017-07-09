<?php

namespace GrillBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GrillBundle\Entity\Image;
use GrillBundle\Form\ImageType;
use GrillBundle\Entity\Griller;
use GrillBundle\Form\GrillerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

class ImageController extends Controller
{
    public Function addAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $griller = $this->getDoctrine()->getRepository('GrillBundle:Griller')->find($id);
        $form = $this->createCreateForm($griller);
        
        return $this->render('GrillBundle:Image:add.html.twig', array('griller' => $griller, 'form' => $form->createView()));
    }
    
    private function createCreateForm(Griller $entity)
    {
                                  
        $form = $this->createForm(ImageType::class, $entity,array('action' => $this->generateUrl('image_create', array('id' => $entity->getid(), 'method' => 'PUT'))));
        
        return $form;
    }
}
