<?php

declare(strict_types=1);

namespace LokiCheckout\MultiSafepay\Test\Integration\Payment\Icon;

use Magento\Framework\App\ObjectManager;
use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\GetObjectManager;
use LokiCheckout\Core\Payment\Icon\IconResolverContext;
use LokiCheckout\MultiSafepay\Payment\Icon\IconResolver;

final class IconResolverTest extends TestCase
{
    use GetObjectManager;

    final public function testInstantiation(): void
    {
        $iconResolver = $this->getInstance();
        $this->assertInstanceOf(IconResolver::class, $iconResolver);
    }

    final public function testResolve(): void
    {
        $iconResolver = $this->getInstance();
        $iconResolverContext = $this->getObjectManager()->create(IconResolverContext::class, [
            'paymentMethodCode' => 'multisafepay',
        ]);
        $actual = $iconResolver->resolve($iconResolverContext);
        $this->assertEquals('', $actual);
    }

    private function getInstance(): IconResolver
    {
        $objectManager = ObjectManager::getInstance();
        return $objectManager->create(IconResolver::class);
    }
}
