<?php namespace SMSFetcher;

use SMSFetcher\Providers\GetfreesmsnumberCom;
use SMSFetcher\Providers\ProviderInterface;
use SMSFetcher\Providers\ReceivesmsCo;
use SMSFetcher\Providers\ReceiveSmsOnlineInfo;
use SMSFetcher\Providers\SmsreceiveEu;

class Client {
    protected $providers = [
        'receive-sms-online.info'   => ReceiveSmsOnlineInfo::class,
        'getfreesmsnumber.com'      => GetfreesmsnumberCom::class,
        'smsreceive.eu'             => SmsreceiveEu::class,
        'receivesms.co'             => ReceivesmsCo::class
    ];

    public function getProviders(): array {
        return $this->providers;
    }

    public function getProvider(string $provider): ProviderInterface {
        return new $this->providers[$provider]();
    }

}