<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveSmsOnlineCom extends Provider implements ProviderInterface {
    const URL = 'https://receive-sms-online.com/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@id="content"]//p') AS $i => $node) {
            if ((int)preg_replace('/[^0-9]/', '', $node->textContent) < 10) continue;

            $number = new Number();
            $link   = $node->getElementsByTagName('a')->item(0);

            $number->setPhone($link->textContent);
            $number->setUrl($link->getAttribute('href'));
            $number->setCountry($node->getElementsByTagName('img')->item(0)->getAttribute('title'));
            $node->removeChild($link);
            $number->setReceived(explode('message', $node->textContent)[0]);

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}