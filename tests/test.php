<?php require_once './vendor/autoload.php';

$fetcher    = new \SMSFetcher\Client();
$provider   = $fetcher->getProvider('receive-sms-online.info');
$numbers    = $provider->getNumbers();

die(var_dump($provider->getMessages($numbers[0])));