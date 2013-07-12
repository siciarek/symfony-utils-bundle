<?php

namespace Siciarek\SymfonyUtilsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('siciarek_symfony_utils');

        $rootNode
            ->addDefaultsIfNotSet()->children()
            ->arrayNode('accept_cookies')->addDefaultsIfNotSet()->children()
                ->booleanNode('enabled')->defaultTrue()->end()
                ->scalarNode('cookie_name')->defaultValue('cookies_accepted')->cannotBeEmpty()->end()
                ->scalarNode('stylesheet')->defaultValue('/bundles/siciareksymfonyutils/css/cookiesbar.css')->cannotBeEmpty()->end()
                ->scalarNode('privacy_policy_url')->defaultValue('privacy-policy')->cannotBeEmpty()->end()
                ->scalarNode('template')->defaultValue('SiciarekSymfonyUtilsBundle:Common:cookiesbar.html.twig')->cannotBeEmpty()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
