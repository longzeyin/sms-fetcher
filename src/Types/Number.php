<?php namespace SMSFetcher\Types;

class Number {
    protected $country;
    protected $phone;
    protected $received;

    public function __construct(string $country, string $phone, int $received) {
        $this->country  = trim($country);
        $this->phone    = preg_replace('/[^\+0-9]/', '', $phone);
        $this->received = $received;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getReceived(): int {
        return $this->received;
    }
}