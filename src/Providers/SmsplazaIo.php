<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsplazaIo extends Provider implements ProviderInterface {
    const URL = 'https://smsplaza.io';

    public function getNumbers() {
        $xpath  = $this->getXpath(self::URL);
        $data   = [];
        $rows   = json_decode($xpath->query('//input[@id="freeSms"]')->item(0)->getAttribute('value'), true);

        foreach ($rows AS $row) {
            $number = new Number();

            $number->setPhone($row['number']);
            $number->setCountry($row['country']);
            $number->setUrl('https://smsplaza.io/');

            $data[] = $number;
        }

        return $data;
    }
}