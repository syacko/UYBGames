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

        return $this->render('setup.html.twig.test',
            array('jsLibrary' => $this->getParameter('js_library'),
                'cssLibrary' => $this->getParameter('css_library'),
                'imgLibrary' => $this->getParameter('img_library'),
            ));
    }
}
