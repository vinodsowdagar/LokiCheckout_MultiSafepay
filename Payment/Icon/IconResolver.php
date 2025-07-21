<?php declare(strict_types=1);

namespace LokiCheckout\MultiSafepay\Payment\Icon;

use Magento\Framework\Module\Manager as ModuleManager;
use MultiSafepay\ConnectCore\Model\Ui\Gateway\CreditCardConfigProvider;
use MultiSafepay\ConnectCore\Util\GenericGatewayUtil;
use LokiCheckout\Core\Payment\Icon\IconResolverContext;
use LokiCheckout\Core\Payment\Icon\IconResolverInterface;
use LokiCheckout\Core\ViewModel\CheckoutState;

class IconResolver implements IconResolverInterface
{
    public function __construct(
        private ModuleManager $moduleManager,
        private CheckoutState $checkoutState,
        private GenericGatewayUtil $genericGatewayUtil,
        private CreditCardConfigProvider $creditCardConfigProvider,
        private string $imageTag = '<img src="%s" />',
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

        $gatewayImageUrl = $this->getGatewayImageUrl($iconResolverContext);
        if (!empty($gatewayImageUrl)) {
            return str_replace('%s', $gatewayImageUrl, $this->imageTag);
        }

        $creditcardImageUrl = $this->getCreditcardImageUrl($iconResolverContext);
        if (!empty($creditcardImageUrl)) {
            return str_replace('%s', $creditcardImageUrl, $this->imageTag);
        }

        $imageId = $this->getImageId($iconResolverContext);
        if (empty($imageId)) {
            return '';
        }

        $imageUrl = $iconResolverContext->getViewFileUrl($imageId);

        return str_replace('%s', $imageUrl, $this->imageTag);
    }

    private function getImageId(IconResolverContext $iconResolverContext): string|false
    {
        $paymentMethodCode = $iconResolverContext->getPaymentMethodCode();

        $countryId = strtolower($this->checkoutState->getQuote()->getBillingAddress()->getCountryId());
        $imageId = 'MultiSafepay_ConnectCore::images/'.$paymentMethodCode.'-'.$countryId.'.png';
        if ($this->isValidImageId($iconResolverContext, $imageId)) {
            return $imageId;
        }

        $imageId = 'MultiSafepay_ConnectCore::images/'.$paymentMethodCode.'.png';
        if ($this->isValidImageId($iconResolverContext, $imageId)) {
            return $imageId;
        }

        return false;
    }

    private function isValidImageId(IconResolverContext $iconResolverContext, string|false $imageId): bool
    {
        if (false === $imageId || empty($imageId)) {
            return false;
        }

        return $iconResolverContext->isValidViewFileUrl($imageId);
    }

    private function getGatewayImageUrl(IconResolverContext $iconResolverContext): string|false
    {
        $paymentMethodCode = $iconResolverContext->getPaymentMethodCode();
        return $this->genericGatewayUtil->getGenericFullImagePath($paymentMethodCode);
    }

    private function getCreditcardImageUrl(IconResolverContext $iconResolverContext): string|false
    {
        $paymentMethodCode = $iconResolverContext->getPaymentMethodCode();
        if ($paymentMethodCode !== 'multisafepay_creditcard') {
            return false;
        }

        $image = $this->creditCardConfigProvider->getImage();
        return $image;
    }
}
