<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceivesmsCo extends Provider implements ProviderInterface {
    const URL = 'https://www.receivesms.co';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL.'/active-numbers/');
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//table[@class="table table-hover sortable"]//tbody//tr') AS $i => $node) {
            $number = new Number();
            $nodes  = $node->getElementsByTagName('td');

            $number->setPhone($nodes->item(2)->textContent);
            $number->setCountry($nodes->item(1)->textContent);
            $number->setUrl(self::URL.$nodes->item(4)->getElementsByTagName('a')->item(0)->getAttribute('href'));

            $data[] = $number;
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}