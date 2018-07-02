<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveSmsOnlineInfo extends Provider implements ProviderInterface {
    const URL = 'https://www.receive-sms-online.info/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="Cell"]//div') AS $i => $node) {
            $number = new Number();

            if ($node->childNodes->item(1)->nodeName == 'img') {
                $node->removeChild($node->childNodes->item(1));
            }

            $number->setPhone($node->childNodes->item(2)->firstChild->nextSibling->textContent);
            $number->setCountry($node->childNodes->item(0)->textContent);
            $number->setUrl(self::URL.$node->childNodes->item(2)->getAttribute('href'));
            $number->setReceived(preg_replace('/[^0-9]/', '', $node->childNodes->item(3)->textContent));

            $data[] = $number;
        }

        return $data;
    }
}