<?php

namespace TheGame\SetupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TheGame\MapsBundle\Entity\Maps;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\DBAL\Query\Expression;

class DefaultController extends Controller
{
    /**
     * @Route("/setup/")
     */
    public function indexAction()
    {
        $map = new Maps();
        $map->setMapName('TEST MAP 1');

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
}
