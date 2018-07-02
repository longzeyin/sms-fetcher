<?php require_once './vendor/autoload.php';

$fetcher = new \SMSFetcher\Client();

die(var_dump($fetcher->getProvider('freeonlinephone.org')->getNumbers()));