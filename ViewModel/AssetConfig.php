<?php declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use MultiSafepay\ConnectCore\Config\Config;

class AssetConfig implements ArgumentInterface
{
    public function __construct(
        private Config $config
    ) {
    }

    public function getBaseUrl(): string
    {
        if ($this->config->isLiveMode()) {
            return 'https://pay.multisafepay.com/';
        }

        return 'https://testpay.multisafepay.com/';
    }

    public function getComponentJsUrl(): string
    {
        return $this->getBaseUrl().'sdk/components/v2/components.js';
    }

    public function getComponentCssUrl(): string
    {
        return $this->getBaseUrl().'sdk/components/v2/components.css';
    }
}
