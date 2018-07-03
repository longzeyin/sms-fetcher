<?php namespace SMSFetcher;

use SMSFetcher\Providers\FreeonlinephoneOrg;
use SMSFetcher\Providers\GetfreesmsnumberCom;
use SMSFetcher\Providers\ProviderInterface;
use SMSFetcher\Providers\ReceivesmsCo;
use SMSFetcher\Providers\ReceiveSmsCom;
use SMSFetcher\Providers\ReceiveSmsOnlineCom;
use SMSFetcher\Providers\ReceiveSmsOnlineInfo;
use SMSFetcher\Providers\SmsOnlineCo;
use SMSFetcher\Providers\SmsreceiveEu;
use SMSFetcher\Providers\SmsSellaiteCom;

class Client {
    protected $providers = [
        'receive-sms-online.info'   => ReceiveSmsOnlineInfo::class,
        'getfreesmsnumber.com'      => GetfreesmsnumberCom::class,
        'smsreceive.eu'             => SmsreceiveEu::class,
        'receivesms.co'             => ReceivesmsCo::class,
        'sms-online.co'             => SmsOnlineCo::class,
        'receive-sms-online.com'    => ReceiveSmsOnlineCom::class,
        'freeonlinephone.org'       => FreeonlinephoneOrg::class,
        'sms.sellaite.com'          => SmsSellaiteCom::class,
        'receive-sms.com'           => ReceiveSmsCom::class
    ];

    public function getProviders(): array {
        return $this->providers;
    }

    public function getProvider(string $provider): ProviderInterface {
        return new $this->providers[$provider]();
    }

}