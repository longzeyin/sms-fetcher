<?php namespace SMSFetcher;

use SMSFetcher\Providers\FreeonlinephoneOrg;
use SMSFetcher\Providers\GetfreesmsnumberCom;
use SMSFetcher\Providers\ProviderInterface;
use SMSFetcher\Providers\ReceiveASmsCom;
use SMSFetcher\Providers\ReceivesmsCo;
use SMSFetcher\Providers\ReceiveSmsCom;
use SMSFetcher\Providers\ReceiveSmsOnlineCom;
use SMSFetcher\Providers\ReceiveSmsOnlineInfo;
use SMSFetcher\Providers\SmsnumbersonlineCom;
use SMSFetcher\Providers\SmsOnlineCo;
use SMSFetcher\Providers\SmsreceiveEu;
use SMSFetcher\Providers\SmsSellaiteCom;
use SMSFetcher\Providers\Smstibo;

class Client {
    protected $providers = [
        'receive-sms-online.info'   => ReceiveSmsOnlineInfo::class,
        'getfreesmsnumber.com'      => GetfreesmsnumberCom::class,
        'smsreceive.eu'             => SmsreceiveEu::class,
        'sms-online.co'             => SmsOnlineCo::class,
        'receive-sms-online.com'    => ReceiveSmsOnlineCom::class,
        'freeonlinephone.org'       => FreeonlinephoneOrg::class,
        'sms.sellaite.com'          => SmsSellaiteCom::class,
        'receive-sms.com'           => ReceiveSmsCom::class,
        'receive-a-sms.com'         => ReceiveASmsCom::class,
        'smstibo.com'               => Smstibo::class,
        'smsnumbersonline.com'      => SmsnumbersonlineCom::class,

        'receivesms.co'             => ReceivesmsCo::class
    ];

    public function getProviders(): array {
        return $this->providers;
    }

    public function getProvider(string $provider): ProviderInterface {
        return new $this->providers[$provider]();
    }

}