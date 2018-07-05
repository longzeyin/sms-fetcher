<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveSmsCom extends Provider implements ProviderInterface {
    const URL = 'https://receive-sms.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//table[@class="table table-condensed"]//tbody//tr') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->textContent);
            $number->setCountry($node->textContent);
            $number->setUrl(self::URL.$node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}