<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsreceiveEu extends Provider implements ProviderInterface {
    const URL = 'https://smsreceive.eu/en/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL.'freesms');
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//a[@class="free-sms-block"]') AS $i => $node) {
            $country    = $node->firstChild->nextSibling->firstChild->nextSibling->nextSibling->nextSibling;
            $phone      = $country->nextSibling->nextSibling;
            $received   = $phone->nextSibling->nextSibling->lastChild->textContent;
            $number     = new Number();

            $number->setPhone($phone->textContent);
            $number->setCountry($country->textContent);
            $number->setUrl(self::URL.$node->getAttribute('href'));
            $number->setReceived($received);

            $data[] = $number;
        }

        return $data;
    }
}