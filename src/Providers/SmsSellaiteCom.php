<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsSellaiteCom extends Provider implements ProviderInterface {
    const URL = 'http://sms.sellaite.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//table[@class="up"]') AS $i => $node) {
            $number = new Number();
            $nodes  = $node->getElementsByTagName('tr');

            $number->setPhone($nodes->item(0)->textContent);
            $number->setCountry($nodes->item(1)->getElementsByTagName('td')->item(1)->textContent);
            $number->setUrl(self::URL.$nodes->item(0)->getElementsByTagName('a')->item(0)->getAttribute('href'));
            $number->setReceived($nodes->item(3)->textContent);

            $data[] = $number;
        }

        return $data;
    }
}