<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsOnlineCo extends Provider implements ProviderInterface {
    const URL = 'https://sms-online.co/receive-free-sms';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="number-boxes-item"]') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->getElementsByTagName('h4')->item(0)->textContent);
            $number->setCountry($node->getElementsByTagName('h5')->item(0)->textContent);
            $number->setUrl($node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}