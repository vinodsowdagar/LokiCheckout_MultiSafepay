<?php

declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Test\Integration\Payment\Redirect;

use Magento\Catalog\Test\Fixture\Product as ProductFixture;
use Magento\Checkout\Test\Fixture\PlaceOrder as PlaceOrderFixture;
use Magento\Checkout\Test\Fixture\SetBillingAddress as SetBillingAddressFixture;
use Magento\Checkout\Test\Fixture\SetDeliveryMethod as SetDeliveryMethodFixture;
use Magento\Checkout\Test\Fixture\SetGuestEmail as SetGuestEmailFixture;
use Magento\Checkout\Test\Fixture\SetPaymentMethod as SetPaymentMethodFixture;
use Magento\Checkout\Test\Fixture\SetShippingAddress as SetShippingAddressFixture;
use Magento\Framework\App\ObjectManager;
use Magento\Payment\Model\Method\Adapter as PaymentMethod;
use Magento\Quote\Test\Fixture\AddProductToCart as AddProductToCartFixture;
use Magento\Quote\Test\Fixture\GuestCart;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\Order\Payment\Info as PaymentInfo;
use Magento\TestFramework\Fixture\AppArea;
use Magento\TestFramework\Fixture\Config;
use Magento\TestFramework\Fixture\DataFixture;
use Magento\TestFramework\Fixture\DataFixtureStorageManager;
use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\GetObjectManager;
use Yireo\LokiCheckout\Step\FinalStep\RedirectContext;
use Yireo\LokiCheckoutMultiSafepay\Payment\Redirect\RedirectResolver;
use Magento\Framework\Api\SearchCriteriaBuilder;

class RedirectResolverTest extends TestCase
{
    use GetObjectManager;

    final public function testInstantiation(): void
    {
        $redirectResolver = $this->getInstance();
        $this->assertInstanceOf(RedirectResolver::class, $redirectResolver);
    }

    public function testResolve(): void
    {
        $payment = $this->createMock(PaymentInfo::class);
        $payment->method('getAdditionalInformation')->willReturn('foobar');

        $order = $this->createMock(OrderInterface::class);
        $order->method('getPayment')->willReturn($payment);

        $redirectResolver = $this->getInstance();

        $paymentMethod = $this->createMock(PaymentMethod::class);
        $paymentMethod->method('getCode')->willReturn('multisafepay_banktransfer');

        $redirectContext = $this->createMock(RedirectContext::class);
        $redirectContext->method('getOrder')->willReturn($order);
        $redirectContext->method('getPaymentMethod')->willReturn($paymentMethod);

        $actual = $redirectResolver->resolve($redirectContext);
        $this->assertEquals('foobar', $actual);
    }

    private function getInstance(): RedirectResolver
    {
        $objectManager = ObjectManager::getInstance();

        return $objectManager->create(RedirectResolver::class);
    }
}
