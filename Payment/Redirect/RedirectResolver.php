<?php declare(strict_types=1);

namespace LokiCheckout\MultiSafepay\Payment\Redirect;

use Magento\Payment\Model\Method\Adapter;
use MultiSafepay\ConnectCore\Service\PaymentLink;
use LokiCheckout\Core\Payment\Redirect\RedirectResolverInterface;
use LokiCheckout\Core\Step\FinalStep\RedirectContext;

class RedirectResolver implements RedirectResolverInterface
{
    public function __construct(
        private PaymentLink $paymentLink
    ) {
    }

    public function resolve(RedirectContext $redirectContext): false|string
    {
        $paymentMethod = $redirectContext->getPaymentMethod();
        if (false === $paymentMethod) {
            return false;
        }

        /** @var Adapter $paymentMethod */
        if (false === str_starts_with($paymentMethod->getCode(), 'multisafepay')) {
            return false;
        }

        return $this->paymentLink->getPaymentLinkFromOrder($redirectContext->getOrder());
    }
}
