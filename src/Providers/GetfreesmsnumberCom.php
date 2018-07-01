<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class GetfreesmsnumberCom extends Provider implements ProviderInterface {
    const URL = 'https://getfreesmsnumber.com/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="nostyle"]') AS $i => $node) {
            $country    = $node->firstChild->nextSibling->nextSibling;
            $phone      = $country->nextSibling->nextSibling;
            $url        = $phone->nextSibling->nextSibling;
            $number     = new Number();

            $number->setPhone($phone->textContent);
            $number->setCountry($country->textContent);
            $number->setUrl(self::URL.$url->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}