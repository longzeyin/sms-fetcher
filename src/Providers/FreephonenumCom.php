<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class FreephonenumCom extends Provider implements ProviderInterface {
    const URL = 'https://freephonenum.com/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="row d-flex justify-content-center"]//div[@class="col-lg-3"]') AS $i => $node) {
            $country    = $node->getElementsByTagName('a')->item(0)->textContent;
            $xpathNode  = $this->getXpath($node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            /** @var \DOMElement $subNode */
            foreach ($xpathNode->query('//div[@class="row d-flex justify-content-center"]//div[@class="col-lg-3"]') AS $subNode) {
                $a = $subNode->getElementsByTagName('a')->item(0);

                if (is_null($a)) {
                    continue;
                }

                $number = new Number();
                $number->setPhone($a->getElementsByTagName('div')->item(0)->textContent);
                $number->setCountry($country);
                $number->setUrl(self::URL.$a->getAttribute('href'));

                $data[] = $number;
            }

            sleep(1);
        }

        return $data;
    }
}