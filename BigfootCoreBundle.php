<?php

namespace Bigfoot\Bundle\CoreBundle;

use Bigfoot\Bundle\CoreBundle\DependencyInjection\Compiler\FormatterCompilerPass;
use Bigfoot\Bundle\CoreBundle\DependencyInjection\Compiler\GedmoCompilerPass;
use Bigfoot\Bundle\CoreBundle\DependencyInjection\Compiler\SetRouterPass;
use Symfony\Cmf\Component\Routing\DependencyInjection\Compiler\RegisterRoutersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class BigfootCoreBundle
 * @package Bigfoot\Bundle\CoreBundle
 */
class BigfootCoreBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FormatterCompilerPass());
        $container->addCompilerPass(new SetRouterPass());
        $container->addCompilerPass(new GedmoCompilerPass());
    }
}
