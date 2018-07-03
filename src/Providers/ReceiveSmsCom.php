<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveSmsCom extends Provider implements ProviderInterface {
    const URL = 'https://receive-sms.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//table[@class="table table-condensed"]//tbody//tr') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->childNodes->item(0)->firstChild->childNodes->item(1)->textContent);
            $number->setCountry(preg_replace('/[^A-Za-z]/', '', $node->childNodes->item(2)->textContent));
            $number->setUrl(self::URL.$node->childNodes->item(0)->firstChild->childNodes->item(1)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}