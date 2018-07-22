<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class FreephonenumCom extends Provider implements ProviderInterface {
    const URL = 'https://freephonenum.com/';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];

        /** @var \DOMElement $node */
        foreach ($xpath->query('//div[@class="icons-media-container mbr-white"]//div[contains(@class, "card")]') AS $i => $node) {
            $country    = $node->getElementsByTagName('a')->item(0)->textContent;
            $xpathNode  = $this->getXpath($node->getElementsByTagName('a')->item(0)->getAttribute('href'));

            /** @var \DOMElement $subNode */
            foreach ($xpathNode->query('//div[@class="numbers"]//li') AS $subNode) {
                $div = $subNode->getElementsByTagName('a')->item(0)->getElementsByTagName('div')->item(1);

                foreach ($div->getElementsByTagName('span') AS $span) {
                    $div->removeChild($span);
                }

                foreach ($div->getElementsByTagName('span') AS $span) {
                    $div->removeChild($span);
                }

                $number = new Number();

                $number->setPhone($div->textContent);
                $number->setCountry($country);
                $number->setUrl(self::URL.$subNode->getElementsByTagName('a')->item(0)->getAttribute('href'));

                $data[] = $number;
            }
        }

        return $data;
    }
}