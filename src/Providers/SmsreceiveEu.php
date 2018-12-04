<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsreceiveEu extends Provider implements ProviderInterface {
    const URL = 'https://smsreceive.eu';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="row numbers"]//div[@class="card"]') AS $i => $node) {
            $number     = new Number();
            $country    = explode('-', $node->getElementsByTagName('span')->item(0)->getAttribute('class'));

            $number->setPhone($node->getElementsByTagName('h5')->item(0)->textContent);
            $number->setCountry(end($country));
            $number->setUrl($node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}