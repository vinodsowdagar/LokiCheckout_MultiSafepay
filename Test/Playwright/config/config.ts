import coreConfig from '@loki/config';

export default {
    ...coreConfig,
    modules: [
        'LokiCheckout_MultiSafepay',
        'MultiSafepay_ConnectCore',
        'MultiSafepay_ConnectFrontend',
    ],
    config: {
        ...coreConfig.config,
        'multisafepay/general/mode': 0,
    }
};
