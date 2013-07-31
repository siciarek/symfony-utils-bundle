<?php

namespace Siciarek\SymfonyUtilsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/siciarek/symfony-utils")
 * Class CommonController
 * @package Siciarek\SymfonyUtilsBundle\Controller
 */
class CommonController extends Controller
{
    /**
     * @Route("/photogallery", name="_siciarek_symfony_utils_photogallery")
     * @Template()
     */
    public function photogalleryAction() {
        return array('galleries' => $this->get('sonata.media.manager.gallery')->findBy(array('enabled' => true)));
    }
}
