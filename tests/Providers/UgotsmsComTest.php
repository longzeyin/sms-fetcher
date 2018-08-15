<?php namespace SMSFetcher\Test\Providers;

use PHPUnit\Framework\TestCase;
use SMSFetcher\Client;
use SMSFetcher\Providers\UgotsmsCom;
use SMSFetcher\Types\Number;

class UgotsmsComTest extends TestCase {
    protected static $name = 'ugotsms.com';
    protected static $provider;
    protected static $client;
    protected static $numbers;

    public static function setUpBeforeClass() {
        self::markTestSkipped('Last request error was 500');

        self::$client   = new Client();
        self::$provider = self::$client->getProvider(self::$name);
        self::$numbers  = self::$provider->getNumbers();
    }

    public function testInListProviders() {
        $this->assertArrayHasKey(self::$name, self::$client->getProviders());
        $this->assertEquals(self::$client->getProviders()[self::$name], UgotsmsCom::class);
    }

    public function testHasProviderInstance() {
        $this->assertInstanceOf(UgotsmsCom::class, self::$provider);
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