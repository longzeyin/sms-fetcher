<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveSmsOnlineInfo extends Provider implements ProviderInterface {
    const URL = 'https://www.receive-sms-online.info/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="Cell"]//div') AS $i => $node) {
            $number     = new Number();
            $link       = $node->getElementsByTagName('a')->item(0);
            $received   = $node->getElementsByTagName('strong')->item(0);

            $number->setPhone($link->textContent);
            $number->setUrl(self::URL.$link->getAttribute('href'));
            $number->setReceived($received->textContent);
            $node->removeChild($received);
            $number->setCountry($node->textContent);

            $data[] = $number;
        }

        return $data;
    }
}