<?php
declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Plugin;

use Magento\Quote\Api\PaymentMethodManagementInterface;

class HideDefaultPaymentMethod
{
    public function afterGetList(PaymentMethodManagementInterface $subject, $result, $cartId): array
    {
        return array_filter($result, function ($method) {
            return $method->getCode() !== 'multisafepay';
        });
    }
}
