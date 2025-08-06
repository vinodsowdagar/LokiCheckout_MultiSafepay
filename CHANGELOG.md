# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.2] - 06 August 2025
### Fixed
- Lower PHP requirement to PHP 8.2+

## [2.0.1] - 01 August 2025
### Fixed
- Add dep with Loki_FieldComponents anyway

## [2.0.0] - 22 July 2025
### Fixed
- Bump loki/magento2-components to major 2.0
- Bump `LokiCheckout_Core` to 2.0.0
- Rename PHP namespace from `Yireo_Loki*` to `Loki*`
- Rename composer package from `yireo/magento2-loki*` to `loki/magento2*`

## [1.0.2] - 19 June 2025
### Fixed
- Use Loki test-case in Playwright to detect JS errors automatically
- Rewrite @helpers to @loki in Playwright tests
- Draft of ApplePay behaviour
- Fix malfunctioning integration test

## [1.0.1] - 22 May 2025
### Fixed
- Switch test vs live mode for component URLs
- Implement MultiSafepayPaymentComponent object in Playwright
- Rename MultiSafepay object to MultiSafepayPortal
- Rename LokiCheckoutPaymentComponent to LokiCheckoutMultiSafepayPaymentComponent

## [1.0.0] - 21 May 2025
### Fixed
- Fix payment component was always rendered
- Add `MultiSafepay_ConnectFrontend` as dep
- Add integration tests
- Add Playwright tests
- Add support for creditcard custom image
- Add support for gateway image
- Put all components in a group

## [0.0.2] - 19 May 2025
### Fixed
- Add Payment Components where needed
- Do not hide "multisafepay"
- Redirect also method "multisafepay"
- Add initial tests

## [0.0.1] - 14 May 2025
- Initial release
