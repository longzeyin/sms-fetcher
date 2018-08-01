<?php namespace SMSFetcher;

use SMSFetcher\Providers\CatchsmsCom;
use SMSFetcher\Providers\FreeonlinephoneOrg;
use SMSFetcher\Providers\FreephonenumCom;
use SMSFetcher\Providers\FreesmscodeCom;
use SMSFetcher\Providers\GetfreesmsnumberCom;
use SMSFetcher\Providers\ProviderInterface;
use SMSFetcher\Providers\ReceiveASmsCom;
use SMSFetcher\Providers\ReceivesmsCo;
use SMSFetcher\Providers\ReceiveSmsCom;
use SMSFetcher\Providers\ReceivesmsnumberCom;
use SMSFetcher\Providers\ReceiveSmsOnlineCom;
use SMSFetcher\Providers\ReceiveSmsOnlineInfo;
use SMSFetcher\Providers\SevenSim;
use SMSFetcher\Providers\SmslistenCom;
use SMSFetcher\Providers\SmsnumbersonlineCom;
use SMSFetcher\Providers\SmsOnlineCo;
use SMSFetcher\Providers\SmsplazaIo;
use SMSFetcher\Providers\SmsreceiveEu;
use SMSFetcher\Providers\SmsreceiveonlineCom;
use SMSFetcher\Providers\SmsreceivingCom;
use SMSFetcher\Providers\SmsSellaiteCom;
use SMSFetcher\Providers\Smstibo;
use SMSFetcher\Providers\UgotsmsCom;

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
        'receivesmsnumber.com'      => ReceivesmsnumberCom::class,
        'freesmscode.com'           => FreesmscodeCom::class,
        'catchsms.com'              => CatchsmsCom::class,
        'smsreceiveonline.com'      => SmsreceiveonlineCom::class,
        'smslisten.com'             => SmslistenCom::class,
        'ugotsms.com'               => UgotsmsCom::class,
        'smsplaza.io'               => SmsplazaIo::class,
        'smsreceiving.com'          => SmsreceivingCom::class,

        'freephonenum.com'          => FreephonenumCom::class,
        'receivesms.co'             => ReceivesmsCo::class,
        '7sim.net'                  => SevenSim::class
    ];

    public function getProviders(): array {
        return $this->providers;
    }

    public function getProvider(string $provider): ProviderInterface {
        return new $this->providers[$provider]();
    }

}