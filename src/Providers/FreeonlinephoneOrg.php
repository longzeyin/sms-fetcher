<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class FreeonlinephoneOrg extends Provider implements ProviderInterface {
    const URL = 'https://www.freeonlinephone.org/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="inner-page row-fluid"][@id="num"]') AS $i => $node) {
            $number = new Number();
            $ex     = explode('-', $node->getElementsByTagName('div')->item(1)->textContent);

            $number->setPhone($node->getElementsByTagName('a')->item(0)->textContent);
            $number->setCountry($ex[0]);
            $number->setUrl($node->getElementsByTagName('a')->item(0)->getAttribute('href'));
            $number->setReceived($node->getElementsByTagName('div')->item(1)->textContent);

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}