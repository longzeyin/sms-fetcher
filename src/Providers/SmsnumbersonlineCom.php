<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsnumbersonlineCom extends Provider implements ProviderInterface {
    const URL = 'https://smsnumbersonline.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//article[@class="post"]//div[@class="number"]') AS $i => $node) {
            $number = new Number();
            $nodes = $node->getElementsByTagName('div');

            $number->setPhone($nodes->item(1)->textContent);
            $number->setCountry($nodes->item(0)->textContent);
            $number->setUrl(self::URL.$node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}