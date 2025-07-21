<?php declare(strict_types=1);

namespace LokiCheckout\MultiSafepay\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use LokiCheckout\Core\Component\Checkout\Billing\PaymentMethods\PaymentMethodsViewModel;

class AddPaymentInstructionsPlugin
{
    public function __construct(
        private ScopeConfigInterface $scopeConfig,
    ) {
    }

    public function afterGetPaymentInstructions(
        PaymentMethodsViewModel $subject,
        string $result,
        string $paymentCode
    ): string {
        if (!empty($result)) {
            return $result;
        }

        if (false === str_starts_with($paymentCode, 'multisafepay')) {
            return $result;
        }

        return (string)$this->scopeConfig->getValue('payment/'.$paymentCode.'/instructions');
    }
}
