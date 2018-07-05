<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsreceiveEu extends Provider implements ProviderInterface {
    const URL = 'https://smsreceive.eu/en/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL.'freesms');
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//a[@class="free-sms-block"]') AS $i => $node) {
            $number = new Number();
            $nodes  = $node->getElementsByTagName('p');

            $number->setPhone($nodes->item(2)->textContent);
            $number->setCountry($nodes->item(1)->textContent);
            $number->setUrl(self::URL.$node->getAttribute('href'));
            $number->setReceived($nodes->item(3)->textContent);

            $data[] = $number;
        }

        return $data;
    }
}