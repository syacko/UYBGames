<?php

namespace TheGame\MapsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TheGame\MapsBundle\Entity\Maps;
use TheGame\MapsBundle\Form\MapsType;

/**
 * Maps controller.
 *
 * @Route("/crud/maps")
 */
class MapsController extends Controller
{
    /**
     * Lists all Maps entities.
     *
     * @Route("/", name="crud_maps_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $maps = $em->getRepository('TheGameMapsBundle:Maps')->findAll();

        return $this->render('maps/index.html.twig', array(
            'maps' => $maps,
            'jsLibrary' => $this->getParameter('js_library'),
            'cssLibrary' => $this->getParameter('css_library'),
        ));
    }

    /**
     * Creates a new Maps entity.
     *
     * @Route("/new", name="crud_maps_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $map = new Maps();
        $form = $this->createForm('TheGame\MapsBundle\Form\MapsType', $map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            return $this->redirectToRoute('crud_maps_show', array('id' => $map->getId()));
        }

        return $this->render('maps/new.html.twig', array(
            'map' => $map,
            'jsLibrary' => $this->getParameter('js_library'),
            'cssLibrary' => $this->getParameter('css_library'),
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Maps entity.
     *
     * @Route("/{id}", name="crud_maps_show")
     * @Method("GET")
     */
    public function showAction(Maps $map)
    {
        $deleteForm = $this->createDeleteForm($map);

        return $this->render('maps/show.html.twig', array(
            'map' => $map,
            'jsLibrary' => $this->getParameter('js_library'),
            'cssLibrary' => $this->getParameter('css_library'),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Maps entity.
     *
     * @Route("/{id}/edit", name="crud_maps_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Maps $map)
    {
        $deleteForm = $this->createDeleteForm($map);
        $editForm = $this->createForm('TheGame\MapsBundle\Form\MapsType', $map);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            return $this->redirectToRoute('crud_maps_edit', array('id' => $map->getId()));
        }

        return $this->render('maps/edit.html.twig', array(
            'map' => $map,
            'jsLibrary' => $this->getParameter('js_library'),
            'cssLibrary' => $this->getParameter('css_library'),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Maps entity.
     *
     * @Route("/{id}", name="crud_maps_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Maps $map)
    {
        $form = $this->createDeleteForm($map);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($map);
            $em->flush();
        }

        return $this->redirectToRoute('crud_maps_index');
    }

    /**
     * Creates a form to delete a Maps entity.
     *
     * @param Maps $map The Maps entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Maps $map)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud_maps_delete', array('id' => $map->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
