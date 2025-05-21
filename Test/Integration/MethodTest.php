<?php

declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Test\Integration;

use Magento\Payment\Helper\Data;
use Magento\Payment\Model\PaymentMethodList;
use Magento\Store\Model\StoreManagerInterface;
use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\GetObjectManager;


final class MethodTest extends TestCase
{
    use GetObjectManager;

    final public function testResolve(): void
    {
        $allPaymentMethodCodes = $this->getAllPaymentMethodCodes();
        $this->assertContains('multisafepay_amex', $allPaymentMethodCodes);

        $paymentMethodList = $this->getObjectManager()->get(PaymentMethodList::class);
        $storeManager = $this->getObjectManager()->get(StoreManagerInterface::class);
        $storeId = $storeManager->getStore()->getId();

        $methods = [];
        foreach ($paymentMethodList->getList($storeId) as $paymentMethod) {
            if (str_starts_with($paymentMethod->getCode(), 'multisafepay')) {
                $methods[] = $paymentMethod;
            }
        }

        $this->assertNotEmpty($methods);
    }

    private function getAllPaymentMethodCodes(): array
    {
        $helper = $this->getObjectManager()->get(Data::class);

        return array_keys($helper->getPaymentMethods());
    }
}
