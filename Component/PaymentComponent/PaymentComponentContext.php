<?php declare(strict_types=1);

namespace LokiCheckout\MultiSafepay\Component\PaymentComponent;

use Magento\Framework\App\Config\ScopeConfigInterface;
use LokiCheckout\Core\Util\Component\StepProvider;
use LokiCheckout\Core\ViewModel\CheckoutState;
use LokiCheckout\Core\ViewModel\CurrentStore;
use Loki\Components\Component\ComponentContextInterface;
use MultiSafepay\ConnectCore\Util\ApiTokenUtil;
use MultiSafepay\ConnectCore\Config\Config;

class PaymentComponentContext implements  ComponentContextInterface
{
    public function __construct(
        private CurrentStore $currentStore,
        private CheckoutState $checkoutState,
        private ApiTokenUtil $apiTokenUtil,
        private Config $config,
        private StepProvider $stepProvider,
        private ScopeConfigInterface $scopeConfig,
    ) {
    }

    public function getEnvironment(): string
    {
        return $this->config->isLiveMode($this->checkoutState->getQuote()->getStoreId()) ? 'live' : 'test';
    }

    public function getApiToken(): string
    {
        return $this->apiTokenUtil->getApiTokenFromCache($this->checkoutState->getQuote())['apiToken'] ?? '';
    }

    public function getCurrency(): string
    {
        return $this->currentStore->getCurrency();
    }

    public function getLocale(): string
    {
        return $this->currentStore->getLocale();
    }

    public function getCountryId(): string
    {
        return (string)$this->checkoutState->getQuote()->getBillingAddress()->getCountryId();
    }

    public function getAmount(): int
    {
        $grandTotal = $this->checkoutState->getQuote()->getGrandTotal();
        return (int)$grandTotal * 100;
    }

    public function getCheckoutState(): CheckoutState
    {
        return $this->checkoutState;
    }

    public function getStepProvider(): StepProvider
    {
        return $this->stepProvider;
    }

    public function getConfigValue(string $path): mixed
    {
        return $this->scopeConfig->getValue($path);
    }
}
