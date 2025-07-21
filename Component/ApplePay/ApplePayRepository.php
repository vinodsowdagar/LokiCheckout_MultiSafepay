<?php
declare(strict_types=1);

namespace LokiCheckout\MultiSafepay\Component\ApplePay;

use LokiCheckout\Core\Component\Base\Payment\ApplePay\ApplePayRepository as OriginalRepository;
use LokiCheckout\Core\Payment\ApplePayRequestFactory;

class ApplePayRepository extends OriginalRepository
{
    public function __construct(
        private \MultiSafepay\ConnectCore\Model\Ui\Gateway\ApplePayConfigProvider $applePayConfigProvider
    ) {
    }

    protected function onValidateMerchant(string $validationUrl, string $originDomain): void
    {
        // TODO: Implement onValidateMerchant() method.

        $this->applePayConfigProvider->createApplePayMerchantSession();
    }
}
