<?php namespace SMSFetcher\Test\Providers;

use PHPUnit\Framework\TestCase;
use SMSFetcher\Client;
use SMSFetcher\Providers\SmsOnlineCo;
use SMSFetcher\Types\Number;

class SmsOnlineCoTest extends TestCase {
    protected static $name = 'sms-online.co';
    protected static $provider;
    protected static $client;
    protected static $numbers;

    public static function setUpBeforeClass() {
        self::$client   = new Client();
        self::$provider = self::$client->getProvider(self::$name);
        self::$numbers  = self::$provider->getNumbers();
    }

    public function testInListProviders() {
        $this->assertArrayHasKey(self::$name, self::$client->getProviders());
        $this->assertEquals(self::$client->getProviders()[self::$name], SmsOnlineCo::class);
    }

    public function testHasProviderInstance() {
        $this->assertInstanceOf(SmsOnlineCo::class, self::$provider);
    }

    public function testProviderGetters() {
        $this->assertGreaterThan(0, count(self::$numbers));
    }

    public function testNumberInstance() {
        $this->assertInstanceOf(Number::class, end(self::$numbers));
    }

    public function testNumberValues() {
        $number = end(self::$numbers);

        $this->assertNotEmpty($number->getCountry());
        $this->assertNotEmpty($number->getPhone());
        $this->assertNotEmpty($number->getUrl());
        $this->assertEmpty($number->getReceived());
    }
}