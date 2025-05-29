<?php
declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Component\ApplePay;

use Yireo\LokiCheckout\Component\Base\Payment\ApplePay\ApplePayViewModel as ParentViewModel;
use Yireo\LokiCheckout\Payment\ApplePayRequest;
use Yireo\LokiCheckout\Payment\ApplePayRequestFactory;

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
