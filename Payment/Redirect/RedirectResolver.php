<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Payment\Redirect;

use MultiSafepay\ConnectCore\Model\Method\GenericAdapter;
use MultiSafepay\ConnectCore\Service\PaymentLink;
use Yireo\LokiCheckout\Payment\Redirect\RedirectResolverInterface;
use Yireo\LokiCheckout\Step\FinalStep\RedirectContext;

class RedirectResolver implements RedirectResolverInterface
{
    public function __construct(
        private PaymentLink $paymentLink
    ) {
    }

    public function resolve(RedirectContext $redirectContext): false|string
    {
        $paymentMethod = $redirectContext->getPaymentMethod();
        if (false === $paymentMethod instanceof GenericAdapter) {
            return false;
        }

        return $this->paymentLink->getPaymentLinkFromOrder($redirectContext->getOrder());
    }
}
