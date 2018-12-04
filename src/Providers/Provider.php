<?php namespace SMSFetcher\Providers;

use Faker\Factory;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Provider {
    protected function request(string $url, $headers = []): ResponseInterface {
        $client = new Client(['cookies' => true]);
        $faker  = Factory::create();

        return $client->get($url, [
            'timeout'           => 5,
            'connect_timeout'   => 5,
            'read_timeout'      => 5,
            'headers'           => array_merge([
                'User-Agent'    => $faker->userAgent,
//              'Accept'        => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'en-us'
            ], $headers)
        ]);
    }

    protected function getXpath($url): \DOMXPath {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);

        $response = $this->request($url);
        $doc->loadHTML($response->getBody());

        return new \DOMXPath($doc);
    }
}