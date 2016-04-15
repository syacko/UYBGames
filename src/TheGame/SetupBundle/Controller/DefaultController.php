<?php

namespace TheGame\SetupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/setup/")
     */
    public function indexAction()
    {
//        return $this->render('GameSetupBundle:Default:index.html.twig'); DO NOT USE
        $imgLocal = $this->container->getParameter("img_local");
        $jsLibrary = $this->container->getParameter("js_library");
//        echo $imgLocal;
        return $this->render('GameSetupBundle:Default:setup.html.twig', array('imgLocal' => $imgLocal, 'jsLibrary' => $jsLibrary));
    }
}
