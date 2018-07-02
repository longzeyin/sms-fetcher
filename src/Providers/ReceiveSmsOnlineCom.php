<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveSmsOnlineCom extends Provider implements ProviderInterface {
    const URL = 'https://receive-sms-online.com/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@id="content"]//p') AS $i => $node) {
            if ($node->childNodes->length < 4) {
                continue;
            }

            $number = new Number();

            $number->setPhone($node->childNodes->item(2)->textContent);
            $number->setCountry($node->childNodes->item(1)->getAttribute('title'));
            $number->setUrl($node->childNodes->item(2)->getAttribute('href'));
            $number->setReceived(explode(' ', $node->childNodes->item(3)->textContent)[3]);

            $data[] = $number;
        }

        return $data;
    }
}