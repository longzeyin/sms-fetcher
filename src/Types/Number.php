<?php namespace SMSFetcher\Types;

class Number {
    protected $phone;
    protected $url;
    protected $country;
    protected $received;

    public function setPhone(string $phone) {
        $this->phone = preg_replace('/[^\+0-9]/', '', $phone);
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function setUrl(string $url) {
        $this->url = trim($url);
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function setCountry(string $country) {
        $this->country = trim(preg_replace('/[^\sA-Za-z]/', '', $country));
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function setReceived(int $received) {
        return $this->received = $received;
    }

    public function getReceived(): ?int {
        return $this->received;
    }
}