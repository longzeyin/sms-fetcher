<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveASmsCom extends Provider implements ProviderInterface {
    const URL = 'receive-a-sms.com';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//table[@id="maintable"]//table[@align="center"]//tbody//td') AS $i => $node) {
            $number = new Number();

            $number->setPhone($node->childNodes->item(3)->textContent);
            $number->setCountry($node->childNodes->item(1)->textContent);
            $number->setUrl(self::URL.$node->childNodes->item(1)->childNodes->item(1)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}