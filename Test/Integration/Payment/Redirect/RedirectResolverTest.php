<?php

declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Test\Integration\Payment\Redirect;

use Magento\Framework\App\ObjectManager;
use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\GetObjectManager;
use Yireo\LokiCheckoutMultiSafepay\Payment\Redirect\RedirectResolver;

final class RedirectResolverTest extends TestCase
{
    use GetObjectManager;

    final public function testInstantiation(): void
    {
        $redirectResolver = $this->getInstance();
        $this->assertInstanceOf(RedirectResolver::class, $redirectResolver);
    }

    final public function testResolve(): void
    {
        $redirectResolver = $this->getInstance();
        $actual = $redirectResolver->resolve();
        $this->assertEquals('', $actual);
    }

    private function getInstance(): RedirectResolver
    {
        $objectManager = ObjectManager::getInstance();
        return $objectManager->create(RedirectResolver::class);
    }
}
