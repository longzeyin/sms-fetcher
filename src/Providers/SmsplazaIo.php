<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

class SmsplazaIo extends Provider implements ProviderInterface {
    const URL = 'https://sonetc.smsplaza.io/free/sms';

    public function getNumbers() {
        $response = json_decode($this->request(self::URL)->getBody(), true);

        foreach ($response AS $row) {
            $number = new Number();

            $number->setPhone($row['number']);
            $number->setCountry($row['country']);
            $number->setUrl('https://smsplaza.io/');

            $data[] = $number;
        }

        return $data;
    }
}