<?php

namespace Bigfoot\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BigfootCoreExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($themeBundle = $config['theme']) {
            $bundles = $container->getParameter('kernel.bundles');

            if (isset($bundles[$themeBundle])) {
                $container->setParameter('bigfoot.theme.bundle', $themeBundle);
            } else {
                throw new \InvalidArgumentException(sprintf('The configured theme "%s" does not match any registered bundle. The bigfoot_core.theme value should be an enabled (bigfoot theme) bundle name. Please check the config value is correct and that the bundle is correctly enabled in your AppKernel class.', $themeBundle));
            }
        }

        $container->setParameter('bigfoot_core.mailer.from', $config['mailer']['from']);
        $container->setParameter('bigfoot_core.languages.back', $config['languages']['back']);
        $container->setParameter('bigfoot_core.languages.front', $config['languages']['front']);
        $container->setParameter('bigfoot_core.date_format', $config['date_format']);
        $container->setParameter('bigfoot.scheme', $config['secure'] ? 'https' : 'http');

        $router = $container->getDefinition('bigfoot_core.cmf_routing.router');

        if (isset($config['routing']['replace_symfony_router'])) {
            $container->setParameter('bigfoot_core.routing.replace_symfony_router', $config['routing']['replace_symfony_router']);
        }

        if (isset($config['routing']['routers_by_id'])) {
            $container->setParameter('bigfoot_core.routing.routers_by_id', $config['routing']['routers_by_id']);
        }

        if (isset($config['routing']['replace_symfony_router']) && true === $config['routing']['replace_symfony_router'] && isset($config['routing']['routers_by_id'])) {
            foreach ($config['routing']['routers_by_id'] as $id => $priority) {
                $router->addMethodCall('add', array(new Reference($id), trim($priority)));
            }
        }
    }
}
