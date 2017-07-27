<?php

namespace RyGBundle\Controller;

use RyGBundle\Entity\Runner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Runner controller.
 *
 * @Route("runner")
 */
class RunnerController extends Controller
{
    /**
     * Lists all runner entities.
     *
     * @Route("/", name="runner_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $editionActive = $em->getRepository('RyGBundle:Edition')->findOneByIsActive(true);

        //$runners = $em->getRepository('RyGBundle:Runner')->findAll();
        $runners = $editionActive->getRunners();
        
        return $this->render('runner/index.html.twig', array(
            'runners' => $runners, 'race' => $editionActive,
        ));
    }
    
    /**
     * Lists all runner entities.
     *
     * @Route("/results", name="runner_results")
     * @Method("GET")
     */
    public function resultsAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $editionActive = $em->getRepository('RyGBundle:Edition')->findOneByIsActive(true);

        //$runners = $em->getRepository('RyGBundle:Runner')->findAll();
        $repo = $em->getRepository('RyGBundle:Runner');
        $editionid = $editionActive->getId();
        $query = $repo->createquerybuilder('t')->where('t.edition = :editionActive')->andwhere('t.finishedAt IS NOT NULL')->setparameter('editionActive',$editionActive)->getQuery();
        $runners = $query->getResult();
        //$runners = $em->getRepository('RyGBundle:Runner')->findBy(array('edition' => $editionActive), array('finishedAt' => 'ASC'));
        
        return $this->render('runner/results.html.twig', array(
            'runners' => $runners, 'race' => $editionActive,
        ));
    }

    /**
     * Creates a new runner entity.
     *
     * @Route("/new", name="runner_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $runner = new Runner();
        $form = $this->createForm('RyGBundle\Form\RunnerType', $runner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $edition = $em->getRepository('RyGBundle:Edition')->findOneBy(array('isActive' => true));
            $runner->setEdition($edition);
            $em->persist($runner);
            $em->flush();

            return $this->redirectToRoute('runner_show', array('id' => $runner->getId()));
        }

        return $this->render('runner/new.html.twig', array(
            'runner' => $runner,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a runner entity.
     *
     * @Route("/{id}", name="runner_show")
     * @Method("GET")
     */
    public function showAction(Runner $runner)
    {
        $deleteForm = $this->createDeleteForm($runner);

        return $this->render('runner/show.html.twig', array(
            'runner' => $runner,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing runner entity.
     *
     * @Route("/{id}/edit", name="runner_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Runner $runner)
    {
        $deleteForm = $this->createDeleteForm($runner);
        $editForm = $this->createForm('RyGBundle\Form\RunnerType', $runner);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('runner_edit', array('id' => $runner->getId()));
        }

        return $this->render('runner/edit.html.twig', array(
            'runner' => $runner,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a runner entity.
     *
     * @Route("/{id}", name="runner_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Runner $runner)
    {
        $form = $this->createDeleteForm($runner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($runner);
            $em->flush();
        }

        return $this->redirectToRoute('runner_index');
    }

    /**
     * Creates a form to delete a runner entity.
     *
     * @param Runner $runner The runner entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Runner $runner)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('runner_delete', array('id' => $runner->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Chrono Runner
     *
     * @Route("/{id}/chrono", name="runner_chrono")
     * 
     */
    public function chronoAction(Runner $runner)
    {
        $em = $this->getDoctrine()->getManager();
        $runner->setFinishedAt(new DateTime());
        $em->persist($runner);
        $em->flush();
        
        return $this->redirectToRoute('runner_index');
    }
}
