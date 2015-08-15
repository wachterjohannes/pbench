<?php

namespace PBench\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CollectMapperCompilerPass implements CompilerPassInterface
{
    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $tagName;

    /**
     * @var string
     */
    private $aliasName;

    public function __construct($service, $tagName, $aliasName = 'alias')
    {
        $this->service = $service;
        $this->tagName = $tagName;
        $this->aliasName = $aliasName;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->service)) {
            return;
        }

        $definition = $container->getDefinition($this->service);
        $taggedServices = $container->findTaggedServiceIds($this->tagName);

        foreach ($taggedServices as $id => $tags) {
            $reference = new Reference($id);

            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addDatabaseMapper',
                    array($attributes[$this->aliasName], $reference)
                );
            }
        }
    }
}
