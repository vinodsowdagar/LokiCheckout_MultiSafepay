<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Payment\Icon;

use Magento\Framework\Module\Manager as ModuleManager;
use Yireo\LokiCheckout\Payment\Icon\IconResolverContext;
use Yireo\LokiCheckout\Payment\Icon\IconResolverInterface;

class IconResolver implements IconResolverInterface
{
    public function __construct(
        private ModuleManager $moduleManager,
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

        return '';
    }
}
