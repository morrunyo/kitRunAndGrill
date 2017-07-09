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
     * Displays a form to edit an existing griller entity.
     *
     * @Route("/{id}/edit", name="griller_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Griller $griller)
    {
        $deleteForm = $this->createDeleteForm($griller);
        $editForm = $this->createForm('RyGBundle\Form\GrillerType', $griller);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('griller_edit', array('id' => $griller->getId()));
        }

        return $this->render('griller/edit.html.twig', array(
            'griller' => $griller,
            'edit_form' => $editForm->createView(),
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
