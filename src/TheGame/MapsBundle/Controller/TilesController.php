<?php

namespace TheGame\MapsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TheGame\MapsBundle\Entity\Tiles;
use TheGame\MapsBundle\Form\TilesType;

/**
 * Tiles controller.
 *
 * @Route("/crud/tiles")
 */
class TilesController extends Controller
{
    /**
     * Lists all Tiles entities.
     *
     * @Route("/", name="crud_tiles_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tiles = $em->getRepository('TheGameMapsBundle:Tiles')->findAll();

        return $this->render('tiles/index.html.twig', array(
            'tiles' => $tiles,
            'jsLibrary' => $this->getParameter('js_library'),
            'cssLibrary' => $this->getParameter('css_library'),
        ));
    }

    /**
     * Creates a new Tiles entity.
     *
     * @Route("/new", name="crud_tiles_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tile = new Tiles();
        $form = $this->createForm('TheGame\MapsBundle\Form\TilesType', $tile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tile);
            $em->flush();

            return $this->redirectToRoute('crud_tiles_show', array('id' => $tile->getId()));
        }

        return $this->render('tiles/new.html.twig', array(
            'tile' => $tile,
            'jsLibrary' => $this->getParameter('js_library'),
            'cssLibrary' => $this->getParameter('css_library'),
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tiles entity.
     *
     * @Route("/{id}", name="crud_tiles_show")
     * @Method("GET")
     */
    public function showAction(Tiles $tile)
    {
        $deleteForm = $this->createDeleteForm($tile);

        return $this->render('tiles/show.html.twig', array(
            'tile' => $tile,
            'jsLibrary' => $this->getParameter('js_library'),
            'cssLibrary' => $this->getParameter('css_library'),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tiles entity.
     *
     * @Route("/{id}/edit", name="crud_tiles_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tiles $tile)
    {
        $deleteForm = $this->createDeleteForm($tile);
        $editForm = $this->createForm('TheGame\MapsBundle\Form\TilesType', $tile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tile);
            $em->flush();

            return $this->redirectToRoute('crud_tiles_edit', array('id' => $tile->getId()));
        }

        return $this->render('tiles/edit.html.twig', array(
            'tile' => $tile,
            'jsLibrary' => $this->getParameter('js_library'),
            'cssLibrary' => $this->getParameter('css_library'),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tiles entity.
     *
     * @Route("/{id}", name="crud_tiles_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tiles $tile)
    {
        $form = $this->createDeleteForm($tile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tile);
            $em->flush();
        }

        return $this->redirectToRoute('crud_tiles_index');
    }

    /**
     * Creates a form to delete a Tiles entity.
     *
     * @param Tiles $tile The Tiles entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tiles $tile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crud_tiles_delete', array('id' => $tile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
