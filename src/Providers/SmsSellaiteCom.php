<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsSellaiteCom extends Provider implements ProviderInterface {
    const URL = 'http://sms.sellaite.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//table[@class="up"]') AS $i => $node) {
            $number     = new Number();

            $number->setPhone($node->firstChild->firstChild->textContent);
            $number->setCountry($node->firstChild->nextSibling->firstChild->nextSibling->textContent);
            $number->setUrl(self::URL.$node->firstChild->firstChild->nextSibling->nextSibling->lastChild->lastChild->lastChild->getAttribute('href'));
            $number->setReceived($node->firstChild->nextSibling->nextSibling->nextSibling->lastChild->lastChild->lastChild->textContent);

            $data[] = $number;
        }

        return $data;
    }
}