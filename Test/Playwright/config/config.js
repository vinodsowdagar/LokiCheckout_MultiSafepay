export default {
  modules: [
    'Yireo_LokiCheckoutMultiSafepay',
    'MultiSafepay_ConnectCore',
    'MultiSafepay_ConnectFrontend',
  ],
  profile: 'netherlands',
  config: {
    'multisafepay/general/mode': 0,
    'yireo_loki_checkout/general/theme': 'onestep',
    'currency/options/base': 'EUR',
  }
};
