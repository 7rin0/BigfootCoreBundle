<?php

namespace Bigfoot\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Cmf\Component\Routing\DependencyInjection\Compiler\RegisterRoutersPass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Changes the Router implementation.
 *
 */
class SetRouterPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasParameter('bigfoot_core.routing.replace_symfony_router') && true === $container->getParameter('bigfoot_core.routing.replace_symfony_router')) {
            if ($container->hasParameter('bigfoot_core.routing.routers_by_id')) {
                $container->setAlias('router', 'bigfoot_core.cmf_routing.router');
            }
        }
    }
}
