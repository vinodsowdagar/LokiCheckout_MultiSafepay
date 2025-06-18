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
use Magento\Quote\Test\Fixture\AddProductToCart as AddProductToCartFixture;
use Magento\Quote\Test\Fixture\GuestCart;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\TestFramework\Fixture\AppArea;
use Magento\TestFramework\Fixture\Config;
use Magento\TestFramework\Fixture\DataFixture;
use Magento\TestFramework\Fixture\DataFixtureStorageManager;
use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\GetObjectManager;
use Yireo\LokiCheckout\Step\FinalStep\RedirectContext;
use Yireo\LokiCheckoutMultiSafepay\Payment\Redirect\RedirectResolver;


final class RedirectResolverTest extends TestCase
{
    use GetObjectManager;

    final public function testInstantiation(): void
    {
        $redirectResolver = $this->getInstance();
        $this->assertInstanceOf(RedirectResolver::class, $redirectResolver);
    }

    #[
        AppArea('frontend'),
        Config('payment/multisafepay/active', 1),
        Config('payment/multisafepay/can_use_checkout', 1),
        Config('multisafepay/general/mode', 0),
        DataFixture(ProductFixture::class, as: 'product'),
        DataFixture(GuestCart::class, as: 'cart'),
        DataFixture(AddProductToCartFixture::class, ['cart_id' => '$cart.id$', 'product_id' => '$product.id$']),
        DataFixture(SetBillingAddressFixture::class, ['cart_id' => '$cart.id$']),
        DataFixture(SetShippingAddressFixture::class, ['cart_id' => '$cart.id$']),
        DataFixture(SetGuestEmailFixture::class, ['cart_id' => '$cart.id$']),
        DataFixture(SetDeliveryMethodFixture::class, ['cart_id' => '$cart.id$']),
        DataFixture(SetPaymentMethodFixture::class, [
            'cart_id' => '$cart.id$',
            'method' => [
                'method' => 'multisafepay_banking',
            ],
        ]),
        DataFixture(PlaceOrderFixture::class, ['cart_id' => '$cart.id$'], 'order'),
    ]
    final public function testResolve(): void
    {
        $this->markTestIncomplete('Incomplete');
        $fixtures = DataFixtureStorageManager::getStorage();
        $order = $fixtures->get('order');
        $this->assertInstanceOf(OrderInterface::class, $order);

        $redirectResolver = $this->getInstance();
        $redirectContext = $this->getObjectManager()->get(RedirectContext::class);

        $order = $redirectContext->getOrder();
        $this->assertInstanceOf(OrderInterface::class, $order);

        $actual = $redirectResolver->resolve($redirectContext);
        $this->assertNotEmpty($actual);
    }

    private function getInstance(): RedirectResolver
    {
        $objectManager = ObjectManager::getInstance();

        return $objectManager->create(RedirectResolver::class);
    }
}
