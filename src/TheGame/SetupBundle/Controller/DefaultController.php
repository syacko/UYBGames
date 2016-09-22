<?php

namespace TheGame\SetupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TheGame\MapsBundle\Entity\Maps;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\DBAL\Query\Expression;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Maps controller.
 *
 * @Route("/setup")
 */
class DefaultController extends FOSRestController
{
    /**
     * Displays the Setup Screen.
     *
     * @Route("/", name="setup_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT m.mapName, m.mapImageUrl FROM TheGameMapsBundle:Maps m ORDER BY m.mapName ASC'
        );
        $mapNameResults = $query->getResult();

        //        return $this->render('GameSetupBundle:Default:index.html.twig'); DO NOT USE
        return $this->render('TheGameSetupBundle:Default:setup.html.twig',
            array('jsLibrary' => $this->getParameter('js_library'),
                'cssLibrary' => $this->getParameter('css_library'),
                'imgLibrary' => $this->getParameter('img_library'),
                'mapNameResults' => $mapNameResults,
            ));
    }

    /**
     * Saves tile configuration data
     *
     * @Route("/saveconfig", name="setup_saveconfig")
     * @Method({"GET", "POST"})
     */
    public function saveconfigAction(Request $request)
    {
        var_dump($request);
        echo "<br><br><br>";
        var_dump($request->server);
        echo "<br><br><br>";
        $serverData = $request->server;
        var_dump($serverData->get('QUERY_STRING'));
        echo "<br><br><br>";

        $view = $this->view($request, 200)
            ->setTemplate("TheGameSetupBundle:Default:saveconfig.html.twig")
            ->setData($request);

        return $this->handleView($view);
    }
}
