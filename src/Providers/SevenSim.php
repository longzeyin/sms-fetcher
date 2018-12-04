<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SevenSim extends Provider implements ProviderInterface {
    const URL = 'http://7sim.net/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="tab-content"]//div[@role="tabpanel"]') AS $node) {
            $country = $node->getElementsByTagName('h4')->item(0)->textContent;

            foreach ($node->getElementsByTagName('div')->item(0)->getElementsByTagName('div') AS $subnode) {
                $number = new Number();
                $link = $subnode->getElementsByTagName('a')->item(0);

                if (empty($link->textContent)) {
                    continue;
                }

                $number->setPhone($link->textContent);
                $number->setCountry($country);
                $number->setUrl($link->getAttribute('href'));
                $data[] = $number;
            }
        }

        return $data;
    }

    public function getMessages(Number $number) {
        return [];
    }
}