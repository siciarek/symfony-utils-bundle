<?php

namespace Siciarek\SymfonyUtilsBundle\Twig\Extension;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class SiciarekSymfonyUtilsExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'application_main_twig_extension';
    }

    /**
     * Filters declaration
     */
    public function getFilters()
    {
        return array(

        );
    }

    /**
     * Functions declaration
     */
    public function getFunctions()
    {
        return array(
            'accept_cookies' => new \Twig_Function_Method($this, 'accept_cookies', array('needs_environment' => true, 'is_safe' => array('html'))),
        );
    }

    /**
     * Cookies acceptance bar
     */
    public function accept_cookies(\Twig_Environment $twig, $url = 'xyz') {
        return $twig->render('SiciarekSymfonyUtilsBundle:Common:cookiesbar.html.twig', array('privacy_policy_url' => $url));
    }
}
