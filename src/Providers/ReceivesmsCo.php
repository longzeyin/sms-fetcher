<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceivesmsCo extends Provider implements ProviderInterface {
    const URL = 'https://www.receivesms.co';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL.'/active-numbers/');
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//table[@class="table table-hover sortable"]//tbody//tr') AS $i => $node) {
            $number     = new Number();

            $number->setPhone($node->childNodes->item(4)->textContent);
            $number->setCountry($node->childNodes->item(2)->textContent);
            $number->setUrl(self::URL.$node->childNodes->item(8)->lastChild->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }
}