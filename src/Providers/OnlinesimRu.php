<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class OnlinesimRu extends Provider implements ProviderInterface {
    const URL = 'http://onlinesim.ru/sms-receive';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@id="menu-list"]//li') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->getElementsByTagName('strong')->item(0)->textContent);
            $number->setUrl(self::URL);

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}