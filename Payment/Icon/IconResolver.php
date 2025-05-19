<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Payment\Icon;

use Magento\Framework\Module\Manager as ModuleManager;
use Yireo\LokiCheckout\Payment\Icon\IconResolverContext;
use Yireo\LokiCheckout\Payment\Icon\IconResolverInterface;
use Yireo\LokiCheckout\ViewModel\CheckoutState;

class IconResolver implements IconResolverInterface
{
    public function __construct(
        private ModuleManager $moduleManager,
        private CheckoutState $checkoutState,
    ) {
    }

    public function resolve(IconResolverContext $iconResolverContext): false|string
    {
        $paymentMethodCode = $iconResolverContext->getPaymentMethodCode();
        if (false === $this->moduleManager->isEnabled('MultiSafepay_ConnectCore')) {
            return false;
        }

        if (!preg_match('/^multisafepay_(.*)$/', $paymentMethodCode)) {
            return false;
        }

        $countryId = strtolower($this->checkoutState->getQuote()->getBillingAddress()->getCountryId());
        $imageId = 'MultiSafepay_ConnectCore::images/'.$paymentMethodCode.'-'.$countryId.'.png';
        if (false === $iconResolverContext->isValidViewFileUrl($imageId)) {
            $imageId = 'MultiSafepay_ConnectCore::images/'.$paymentMethodCode.'.png';
        }

        $imageUrl = $iconResolverContext->getViewFileUrl($imageId);

        return '<img src="'.$imageUrl.'" />';
    }
}
