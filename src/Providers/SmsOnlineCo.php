<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsOnlineCo extends Provider implements ProviderInterface {
    const URL = 'https://sms-online.co/receive-free-sms';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="number-boxes-item"]') AS $i => $node) {
            $number     = new Number();

            $number->setPhone($node->childNodes->item(2)->textContent);
            $number->setCountry($node->childNodes->item(4)->textContent);
            $number->setUrl($node->childNodes->item(6)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}