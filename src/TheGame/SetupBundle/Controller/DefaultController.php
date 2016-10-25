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

        $logger = $this->get('logger');
        $logger->info('=============================================');
        $logger->info('=============================================');
        $logger->info('=============================================');
        $logger->info('CODE LOCATION: ' . __FUNCTION__ . ':' . __CLASS__);
        $logger->info('==> Tile Config Data (mapid): ' . $tileConfigData['mapid'] . ' (col/row): ' . $tileConfigData['colrow']);

        $em = $this->getDoctrine()->getManager();
        $q = $em->createQuery('SELECT t.mapId FROM TheGameMapsBundle:Tiles t WHERE t.mapId = :mapid AND t.tileColRow = :colrow');
        $q->setParameter('mapid', $tileConfigData['mapid']);
        $q->setParameter('colrow', $tileConfigData['colrow']);
        $sqlResult = $q->getResult();
        if (count($sqlResult, COUNT_RECURSIVE) < 1) {
            $tiles = new Tiles();
            $tiles->setMapId($tileConfigData['mapid']);
            $tiles->setTileColRow($tileConfigData['colrow']);
            $tiles->setTileData(serialize($tileConfigData['configdata']));
            $em->persist($tiles);
            $logger->info('=== INSERT =============================================');
        } else {
            $q = $em->createQuery('UPDATE TheGameMapsBundle:Tiles t SET t.tileData = :configdata WHERE t.mapId = :mapid AND t.tileColRow = :colrow');
            $q->setParameter('configdata', serialize($tileConfigData['configdata']));
            $q->setParameter('mapid', $tileConfigData['mapid']);
            $q->setParameter('colrow', $tileConfigData['colrow']);
            $numUpdated = $q->execute();
            $logger->info('=== UPDATE === RECS UPDATED: ' . $numUpdated . ' =========================');
        }
        $em->flush();

        $view = $this->view($request, 200)
            ->setTemplate("TheGameSetupBundle:Default:configdata.html.twig")
            ->setData($request);

        return $this->handleView($view);
    }

    /**
     * Read tile configuration data
     *
     * @Route("/readconfig", name="setup_readconfig")
     * @Method({"GET", "POST"})
     */
    public function readconfigAction(Request $request)
    {
        $tileConfigData = json_decode($request->getContent(), true);

        $logger = $this->get('logger');
        $logger->info('=============================================');
        $logger->info('=============================================');
        $logger->info('=============================================');
        $logger->info('CODE LOCATION: ' . __FUNCTION__ . ':' . __CLASS__);
        $logger->info('$request->getContent(): ' . $request->getContent());
        $logger->info('==> Tile Config Data (mapid): ' . $tileConfigData['mapid'] . ' (col/row): ' . $tileConfigData['colrow']);

        $em = $this->getDoctrine()->getManager();
        $q = $em->createQuery('SELECT t.tileData FROM TheGameMapsBundle:Tiles t WHERE t.mapId = :mapid AND t.tileColRow = :colrow');
        $q->setParameter('mapid', $tileConfigData['mapid']);
        $q->setParameter('colrow', $tileConfigData['colrow']);
        $sqlResult = $q->getResult();
        if (count($sqlResult, COUNT_RECURSIVE) < 1) {
            $view = $this->view($request, 404)
                ->setTemplate("TheGameSetupBundle:Default:configdata.html.twig")
                ->setData($request);
            $logger->info('=== Not Found === Code: 404 ===========================');
        } else {
            $view = $this->view($request, 200)
                ->setTemplate("TheGameSetupBundle:Default:configdata.html.twig")
                ->setData(json_encode(unserialize($sqlResult[0]['tileData'])));
            $logger->info('$sqlResult:' . $sqlResult[0]['tileData']);
            $logger->info('=== Found === Code: 200 ===============================');
        }
        $em->flush();

        return $this->handleView($view);
    }
}
