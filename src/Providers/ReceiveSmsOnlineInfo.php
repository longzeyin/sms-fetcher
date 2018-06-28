<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class ReceiveSmsOnlineInfo extends Provider implements ProviderInterface {
    protected $url = 'https://www.receive-sms-online.info/';

    public function getNumbers() {
        $xpath = $this->getXpath($this->url);

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="Cell"]//div') AS $i => $node) {
            $country    = $node->firstChild;
            $phone      = $country->nextSibling->nextSibling;
            $received   = explode(':', $phone->nextSibling->textContent);
            $data[]     = new Number($country->textContent, $phone->textContent, end($received));
        }

        return $data;
    }
}