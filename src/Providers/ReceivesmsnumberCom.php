<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceivesmsnumberCom extends Provider implements ProviderInterface {
    const URL = 'https://receivesmsnumber.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@id="page-wrap"]//tbody//tr') AS $i => $node) {
            $number = new Number();
            $nodes = $node->getElementsByTagName('td');

            if(empty($nodes->item(1))) {
                continue;
            }

            $number->setPhone($nodes->item(1)->textContent);
            $number->setCountry($nodes->item(0)->textContent);
            $number->setUrl(self::URL.$node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}