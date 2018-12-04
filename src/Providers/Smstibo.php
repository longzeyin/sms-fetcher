<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class Smstibo extends Provider implements ProviderInterface {
    const URL = 'https://smstibo.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//section[@id="three"]//div[@class="number"]') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->getElementsByTagName('h6')->item(0)->textContent);
            $number->setCountry($node->getElementsByTagName('h5')->item(0)->textContent);
            $number->setUrl(self::URL.$node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}