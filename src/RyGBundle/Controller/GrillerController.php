<?php

namespace RyGBundle\Controller;

use RyGBundle\Entity\Griller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Griller controller.
 *
 * @Route("griller")
 */
class GrillerController extends Controller
{
    /**
     * Lists all griller entities.
     *
     * @Route("/", name="griller_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grillers = $em->getRepository('RyGBundle:Griller')->findAll();

        return $this->render('griller/index.html.twig', array(
            'grillers' => $grillers,
        ));
    }

    /**
     * Creates a new griller entity.
     *
     * @Route("/new", name="griller_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $griller = new Griller();
        $form = $this->createForm('RyGBundle\Form\GrillerType', $griller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $edition = $em->getRepository('RyGBundle:Edition')->findOneBy(array('isActive' => true));
            $griller->setEdition($edition);
            
            // Almacenar foto
            $file = $griller->getPhoto();
            $fileName = $edition->getId().'-'.$griller->getId().'.'.$file->guessExtension();
            $file->move($this->getParameter('photos_directory'),$fileName);
            $griller->setPhoto($fileName);
            
            $em->persist($griller);
            $em->flush();

            return $this->redirectToRoute('griller_show', array('id' => $griller->getId()));
        }

        return $this->render('griller/new.html.twig', array(
            'griller' => $griller,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a griller entity.
     *
     * @Route("/{id}", name="griller_show")
     * @Method("GET")
     */
    public function showAction(Griller $griller)
    {
        $deleteForm = $this->createDeleteForm($griller);

        return $this->render('griller/show.html.twig', array(
            'griller' => $griller,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
        /**
     * Finds and displays a griller entity.
     *
     * @Route("/{id}/team", name="griller_team")
     * @Method("GET")
     */
    public function teamAction(Griller $griller)
    {
        $team = $griller->getTeam();
        $em = $this->getDoctrine()->getManager();
        $grillers = $em->getRepository('RyGBundle:Griller')->findByTeam($team);
        
        return $this->render('griller/team.html.twig', array(
            'grillers' => $grillers,
            'team' => $team,
        ));
    }

    /**
     * Displays a form to edit an existing griller entity.
     *
     * @Route("/{id}/edit", name="griller_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Griller $griller)
    {
        $deleteForm = $this->createDeleteForm($griller);
        $photoOriginal = $griller->getPhoto();
        $griller->setPhoto(null);
        $editForm = $this->createForm('RyGBundle\Form\GrillerType', $griller);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // Almacenar foto
            $file = $griller->getPhoto();
            if (!is_null($file))
            {
                $fileName = $griller->getEdition()->getId().'-'.$griller->getId().'.'.$file->guessExtension();
                $file->move($this->getParameter('photos_directory'),$fileName);
                $griller->setPhoto($fileName);
            }
            else{//Dejo la foto que tenia$grilleroriginal = $em->getRepository('RyGBundle:Griller')->findOneById($griller->getId());
                $griller->setPhoto($photoOriginal);
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('griller_show', array('id' => $griller->getId()));
        }

        return $this->render('griller/edit.html.twig', array(
            'griller' => $griller,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a griller entity.
     *
     * @Route("/{id}", name="griller_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Griller $griller)
    {
        $form = $this->createDeleteForm($griller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($griller);
            $em->flush();
        }

        return $this->redirectToRoute('griller_index');
    }

    /**
     * Creates a form to delete a griller entity.
     *
     * @param Griller $griller The griller entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Griller $griller)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('griller_delete', array('id' => $griller->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
