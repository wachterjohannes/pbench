<?php

namespace PBench\Bundle\CoreBundle;

use PBench\Bundle\CoreBundle\DependencyInjection\Compiler\CollectMapperCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PBenchCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CollectMapperCompilerPass('pbench.repository', 'pbench.mapper'));
    }
}
