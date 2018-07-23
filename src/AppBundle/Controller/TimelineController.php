<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Timeline;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Timeline controller.
 *
 * @Route("timeline")
 */
class TimelineController extends Controller
{
    /**
     * Lists all timeline entities.
     *
     * @Route("/show/{graph_id}", name="timeline_index")
     * @Method("GET")
     */
    public function indexAction($graph_id)
    {
        ini_set('memory_limit', '-1');
        $em = $this->getDoctrine()->getManager();
        $graph = $em->getRepository('AppBundle:Graph')->find($graph_id);

        $timelines = $em->getRepository('AppBundle:Timeline')
        ->findBy(
            array('graph' => $graph),
            array('id' => 'DESC')
        );

        return $this->render('timeline/index.html.twig', array(
            'graph' => $graph,
            'timelines' => $timelines,
        ));
    }

    /**
     * Creates a new timeline entity.
     *
     * @Route("/new/{graph_id}", name="timeline_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $graph_id)
    {
        ini_set('memory_limit', '-1');
        $timeline = new Timeline();
        $graph = $this->em()->getRepository('AppBundle:Graph')->find($graph_id);
        $user = $this->user();
        $timelines = $this->em()->getRepository('AppBundle:Timeline')
        ->findBy(
            array('graph' => $graph),
            array('id' => 'ASC')
        );
        $timeline->setUser($user);
        $timeline->setGraph($graph);
        $form = $this->createForm('AppBundle\Form\TimelineType', $timeline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($timeline);
            $em->flush();

            return $this->redirectToRoute('timeline_new', ['graph_id' => $graph_id ]);
        }

        return $this->render('timeline/new.html.twig', array(
            'graph' => $graph,
            'timeline' => $timeline,
            'timelines' => $timelines,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a timeline entity.
     *
     * @Route("/{id}/{graph_id}", name="timeline_show")
     * @Method("GET")
     */
    public function showAction(Timeline $timeline, $graph_id)
    {
        ini_set('memory_limit', '-1');
        $deleteForm = $this->createDeleteForm($timeline);
        $graph = $this->em()->getRepository('AppBundle:Graph')->find($graph_id);
        return $this->render('timeline/show.html.twig', array(
            'graph' => $graph,
            'timeline' => $timeline,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing timeline entity.
     *
     * @Route("/{id}/entries/edit", name="timeline_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Timeline $timeline)
    {
        ini_set('memory_limit', '-1');
        $deleteForm = $this->createDeleteForm($timeline);
        $editForm = $this->createForm('AppBundle\Form\TimelineType', $timeline);
        $editForm->handleRequest($request);
        $graph = $timeline->getGraph();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timeline_index', array('graph_id' => $graph->getId()));
        }

        return $this->render('timeline/edit.html.twig', array(
            'timeline' => $timeline,
            'graph' => $graph,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a timeline entity.
     *
     * @Route("/{id}", name="timeline_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Timeline $timeline)
    {
        ini_set('memory_limit', '-1');
        $form = $this->createDeleteForm($timeline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($timeline);
            $em->flush();
        }

        return $this->redirectToRoute('timeline_index');
    }

    /**
     * Creates a form to delete a timeline entity.
     *
     * @param Timeline $timeline The timeline entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Timeline $timeline)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('timeline_delete', array('id' => $timeline->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function em(){
        $em = $this->getDoctrine()->getManager();
        return $em;
    }

    private function user(){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $user;
    }


}
