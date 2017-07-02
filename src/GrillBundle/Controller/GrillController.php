<?php

namespace GrillBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GrillController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $grills = $this->getDoctrine()->getRepository('GrillBundle:Grill')->findAll();
        return $this->render('GrillBundle:Grill:index.html.twig',$arrayName = array('grills' => $grills));
    }
    
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
     * @Route("/activate/{id}")
     */
    public function activateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $grills = $this->getDoctrine()->getRepository('GrillBundle:Grill')->findAll();
        foreach ($grills as $grill)
        {
            if ($grill->getId()==$id)
            {   
                $grill->setIsActive(true);
            }
            else{
                $grill->setIsActive(false);
            }
            $em->persist($grill);
            $em->flush();
        }
        return $this->render('GrillBundle:Grill:index.html.twig',$arrayName = array('grills' => $grills));
    }

}
