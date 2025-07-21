<?php
declare(strict_types=1);

namespace LokiCheckout\MultiSafepay\Component\ApplePay;

use LokiCheckout\Core\Component\Base\Payment\ApplePay\ApplePayViewModel as ParentViewModel;
use LokiCheckout\Core\Payment\ApplePayRequest;
use LokiCheckout\Core\Payment\ApplePayRequestFactory;

class ApplePayViewModel extends ParentViewModel
{
    public function __construct(
        private ApplePayRequestFactory $applePayRequestFactory
    ) {
    }

    public function getApplePayRequest(): ApplePayRequest
    {
        return $this->applePayRequestFactory->create();
    }
}
