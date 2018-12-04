<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class GetfreesmsnumberCom extends Provider implements ProviderInterface {
    const URL = 'https://getfreesmsnumber.com/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="nostyle"]') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->textContent);
            $number->setUrl(self::URL.$node->getElementsByTagName('a')->item(0)->getAttribute('href'));
            $node->removeChild($node->getElementsByTagName('a')->item(0));
            $number->setCountry($node->textContent);

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}