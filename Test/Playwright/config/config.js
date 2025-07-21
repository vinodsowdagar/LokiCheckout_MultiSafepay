export default {
  modules: [
    'LokiCheckout_MultiSafepay',
    'MultiSafepay_ConnectCore',
    'MultiSafepay_ConnectFrontend',
  ],
  profile: 'netherlands',
  config: {
    'multisafepay/general/mode': 0,
    'loki_checkout/general/theme': 'onestep',
    'currency/options/base': 'EUR',
  }
};
