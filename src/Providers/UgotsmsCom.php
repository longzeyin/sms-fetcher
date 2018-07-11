<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class UgotsmsCom extends Provider implements ProviderInterface {
    const URL = 'https://ugotsms.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="number"]') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->getElementsByTagName('h6')->item(0)->textContent);
            $number->setCountry($node->getElementsByTagName('h5')->item(0)->textContent);
            $number->setUrl(self::URL.$node->getElementsByTagName('a')->item(1)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}