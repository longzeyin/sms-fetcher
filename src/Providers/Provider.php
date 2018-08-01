<?php namespace SMSFetcher\Providers;

use Faker\Factory;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Provider {
    protected function request(string $url): ResponseInterface {
        $client = new Client(['cookies' => true]);
        $faker  = Factory::create();

        return $client->get($url, ['headers' => [
            'User-Agent'    => $faker->userAgent,
            'Accept'        => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'en-us'
        ]]);
    }

    protected function getXpath($url): \DOMXPath {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);

        $response = $this->request($url);
        $doc->loadHTML($response->getBody());

        return new \DOMXPath($doc);
    }
}