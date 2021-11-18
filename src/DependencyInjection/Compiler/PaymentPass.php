<?php

namespace App\DependencyInjection\Compiler;

use App\Payment\PaymentManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class PaymentPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        // always first check if the primary service is defined
        if (!$container->has(PaymentManager::class)) {
            return;
        }

        $definition = $container->findDefinition(PaymentManager::class);
        $taggedServices = $container->findTaggedServiceIds('app.payment_method');

        foreach ($taggedServices as $id => $tags) {
            // add the transport service to the TransportChain service
            $definition->addMethodCall('registerMethod', [new Reference($id)]);
        }
    }
}