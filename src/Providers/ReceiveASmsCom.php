<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveASmsCom extends Provider implements ProviderInterface {
    const URL = 'https://www.receive-a-sms.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//table[@id="maintable"]//table[@align="center"]//tbody//td') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->textContent);
            $number->setCountry($node->textContent);
            $number->setUrl(self::URL.$node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}