<?php

namespace TheGame\SetupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use TheGame\MapsBundle\Entity\Maps;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\DBAL\Query\Expression;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use TheGame\MapsBundle\Entity\Tiles;


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
            'SELECT m.mapName, m.mapImageUrl, m.id FROM TheGameMapsBundle:Maps m ORDER BY m.mapName ASC'
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
        $tileConfigData = json_decode($request->getContent(), true);

//        $logger = $this->get('logger');
//        $logger->info('START===================================================');
//        $logger->info('========================================================');
//        $logger->info('========================================================');
//        $logger->info('========================================================');
//        $logger->info('==> Tile Config Data (mapid): ' . $tileConfigData['mapid']);
//        $logger->info('==> Tile Config Data (col/row): ' . $tileConfigData['colrow']);
//        ob_start();
//        var_dump($tileConfigData['configdata']);
//        $result = ob_get_clean();
//        $logger->info('==> Tile Config Data (configdata): ' . $result);
//        $logger->info('DONE====================================================');

        $tiles = new Tiles();
        $tiles->setMapId($tileConfigData['mapid']);
        $tiles->setTileColRow($tileConfigData['colrow']);
        $tiles->setTileData(serialize($tileConfigData['configdata']));

        $em = $this->getDoctrine()->getManager();
        $em->persist($tiles);
        $em->flush();

        $view = $this->view($request, 200)
            ->setTemplate("TheGameSetupBundle:Default:saveconfig.html.twig")
            ->setData($request);

        return $this->handleView($view);
    }
}
