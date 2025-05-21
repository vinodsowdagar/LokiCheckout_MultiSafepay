<?php

declare(strict_types=1);

namespace Yireo\LokiCheckoutMultiSafepay\Test\Integration;

use PHPUnit\Framework\TestCase;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertModuleIsEnabled;
use Yireo\IntegrationTestHelper\Test\Integration\Traits\AssertModuleIsRegistered;

final class ModuleTest extends TestCase
{
    use AssertModuleIsEnabled;
    use AssertModuleIsRegistered;

    final public function testModule(): void
    {
        $moduleNames = [
            'Yireo_LokiCheckoutMultiSafepay',
            'Yireo_LokiCheckout',
            'Magento_Quote',
            'Magento_Store',
            'MultiSafepay_ConnectCore',
            'MultiSafepay_ConnectFrontend',
        ];

        foreach ($moduleNames as $moduleName) {
            $this->assertModuleIsEnabled($moduleName);
            $this->assertModuleIsRegistered($moduleName);
        }
    }
}
