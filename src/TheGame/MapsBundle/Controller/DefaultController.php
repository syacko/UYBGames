<?php

namespace TheGame\MapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
//        return $this->render('TheGameMapsBundle:Default:index.html.twig'); DO NOT USE

        return $this->render('TheGameMapsBundle:Default:index.html.twig',
            array('jsLibrary' => $this->getParameter('js_library'),
                'cssLibrary' => $this->getParameter('css_library'),
                'imgLibrary' => $this->getParameter('img_library'),
            ));
    }
}
