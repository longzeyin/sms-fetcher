<?php namespace SMSFetcher\Providers;

use SMSFetcher\Types\Number;

interface ProviderInterface {
    public function getNumbers();

    public function getMessages(Number $number);
}