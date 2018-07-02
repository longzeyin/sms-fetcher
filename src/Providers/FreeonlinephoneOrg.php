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

            $number->setPhone($node->childNodes->item(1)->firstChild->nextSibling->textContent);
            $number->setCountry($node->childNodes->item(1)->firstChild->nextSibling->firstChild->firstChild->getAttribute('title'));
            $number->setUrl($node->childNodes->item(1)->firstChild->nextSibling->getAttribute('href'));
            $number->setReceived($node->childNodes->item(3)->firstChild->nextSibling->textContent);

            $data[] = $number;
        }

        return $data;
    }
}