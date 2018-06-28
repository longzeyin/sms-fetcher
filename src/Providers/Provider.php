<?php namespace SMSFetcher\Providers;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Provider {
    protected function request(string $url): ResponseInterface {
        $client = new Client();

        return $client->get($url);
    }

    protected function getXpath($url): \DOMXPath {
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);

        $response = $this->request($url);
        $doc->loadHTML($response->getBody());

        return new \DOMXPath($doc);
    }
}