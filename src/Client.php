<?php namespace SMSFetcher;

use SMSFetcher\Providers\ProviderInterface;
use SMSFetcher\Providers\ReceiveSmsOnlineInfo;

class Client {
    protected $providers = [
        'receive-sms-online.info' => ReceiveSmsOnlineInfo::class
    ];

    public function getProviders(): array {
        return $this->providers;
    }

    public function getProvider(string $provider): ProviderInterface {
        return new $this->providers[$provider]();
    }

}