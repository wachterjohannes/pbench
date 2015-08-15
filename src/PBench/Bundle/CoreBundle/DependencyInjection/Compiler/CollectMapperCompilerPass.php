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
    private $serviceId;

    /**
     * @var string
     */
    private $tagName;

    /**
     * @var string
     */
    private $aliasName;

    public function __construct($serviceId, $tagName, $aliasName = 'alias')
    {
        $this->serviceId = $serviceId;
        $this->tagName = $tagName;
        $this->aliasName = $aliasName;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('acme_mailer.transport_chain')) {
            return;
        }

        $definition = $container->getDefinition($this->serviceId);
        $taggedServices = $container->findTaggedServiceIds($this->tagName);

        foreach ($taggedServices as $id => $tags) {
            $reference = new Reference($id);

            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addDatabaseMapper',
                    array($reference, $attributes[$this->aliasName])
                );
            }
        }
    }
}
