<?php

declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Test\Integration\Plugin;

use Magento\Framework\App\ObjectManager;
use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\GetObjectManager;
use Yireo\LokiCheckoutMultiSafepay\Plugin\HideDefaultPaymentMethod;

final class HideDefaultPaymentMethodTest extends TestCase
{
    use GetObjectManager;

    final public function testInstantiation(): void
    {
        $hideDefaultPaymentMethod = $this->getInstance();
        $this->assertInstanceOf(HideDefaultPaymentMethod::class, $hideDefaultPaymentMethod);
    }

    final public function testAfterGetList(): void
    {
        $hideDefaultPaymentMethod = $this->getInstance();
        $actual = $hideDefaultPaymentMethod->afterGetList();
        $this->assertSame([], $actual);
    }

    private function getInstance(): HideDefaultPaymentMethod
    {
        $objectManager = ObjectManager::getInstance();
        return $objectManager->create(HideDefaultPaymentMethod::class);
    }
}
