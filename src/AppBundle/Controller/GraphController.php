<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Graph;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Graph controller.
 *
 * @Route("graph")
 */
class GraphController extends Controller
{
    /**
     * Lists all graph entities.
     *
     * @Route("/", name="graph_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        ini_set('memory_limit', '-1');
        $user = $this->user();
        $em = $this->getDoctrine()->getManager();

        $graphs = $em->getRepository('AppBundle:Graph')
            ->findBy(
                array('user' => $user),
                array('id' => 'DESC')
            );

        return $this->render('graph/index.html.twig', array(
            'graphs' => $graphs,
        ));
    }

    /**
     * Creates a new graph entity.
     *
     * @Route("/new", name="graph_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        ini_set('memory_limit', '-1');
        $graph = new Graph();
        $user = $this->user();
        $graph->setUser($user);
        $form = $this->createForm('AppBundle\Form\GraphType', $graph);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($graph);
            $em->flush();

            return $this->redirectToRoute('timeline_new', [ 'graph_id' => $graph->getId() ]);
        }

        return $this->render('graph/new.html.twig', array(
            'graph' => $graph,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a graph entity.
     *
     * @Route("/{id}", name="graph_show")
     * @Method("GET")
     */
    public function showAction(Graph $graph)
    {
        ini_set('memory_limit', '-1');
        $deleteForm = $this->createDeleteForm($graph);

        return $this->render('graph/show.html.twig', array(
            'graph' => $graph,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing graph entity.
     *
     * @Route("/{id}/edit", name="graph_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Graph $graph)
    {
        ini_set('memory_limit', '-1');
        $deleteForm = $this->createDeleteForm($graph);
        $editForm = $this->createForm('AppBundle\Form\GraphType', $graph);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('graph_index');
        }

        return $this->render('graph/edit.html.twig', array(
            'graph' => $graph,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a graph entity.
     *
     * @Route("/{id}", name="graph_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Graph $graph)
    {
        ini_set('memory_limit', '-1');
        $form = $this->createDeleteForm($graph);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($graph);
            $em->flush();
        }

        return $this->redirectToRoute('graph_index');
    }

    private function user(){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $user;
    }


    /**
     * Creates a form to delete a graph entity.
     *
     * @param Graph $graph The graph entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Graph $graph)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('graph_delete', array('id' => $graph->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
