<?php

namespace Siciarek\SymfonyUtilsBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class SiciarekSymfonyUtilsExtension extends \Twig_Extension
{
    protected $container;
    protected $config = array();

    /**
     * Constructor
     */
    public function __construct(\Symfony\Component\DependencyInjection\ContainerInterface $container)
    {
        $this->container = $container;
        $this->config = $container->getParameter('siciarek.symfony.utils.config');
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'siciarek_symfony_utils_twig_extension';
    }

    /**
     * Filters declaration
     */
    public function getFilters()
    {
        return array();
    }

    /**
     * Functions declaration
     */
    public function getFunctions()
    {
        return array(
            'photogallery' => new \Twig_Function_Method($this, 'photogallery', array('needs_environment' => true, 'is_safe' => array('html'))),
            'accept_cookies' => new \Twig_Function_Method($this, 'accept_cookies', array('needs_environment' => true, 'is_safe' => array('html'))),
        );
    }


    /**
     * SonataMediaBundle Gallery helper
     * @param \Twig_Environment $twig
     * @param string $service
     * @return null|string
     */
    public function photogallery(\Twig_Environment $twig, $service = 'sonata.media.manager.gallery') {

        // TODO: template and service id + fancybox settings to config

        if($this->container->has($service) === false) {
            return null;
        }

        $galleries = $this->container->get($service)->findBy(array('enabled' => true));
        return $twig->render('SiciarekSymfonyUtilsBundle:Common:photogallery.html.twig', array('galleries' => $galleries));
    }


    /**
     * Cookies acceptance bar
     * @param \Twig_Environment $twig
     * @return string
     */
    public function accept_cookies(\Twig_Environment $twig, $url = null)
    {
        $cnf = $this->config['accept_cookies'];

        if($cnf['enabled'] === false) {
            return '';
        }

        $url = $url === null ? $cnf['privacy_policy_url'] : $url;

        $params = array(
            'stylesheet' => $cnf['stylesheet'],
            'cookie_name' => $cnf['cookie_name'],
            'privacy_policy_url' => $url,
        );

        return $twig->render($cnf['template'], $params);
    }
}
