<?php

namespace Rhinodontypicus\LetsAds;

use GuzzleHttp\Client;

class LetsAdsGateway
{
    /**
     * @param $xmlRequest
     * @return \ErrorException|\SimpleXMLElement
     */
    public function request($xmlRequest)
    {
        $response = $this->getClient()->request('POST', '', [
            'body' => $xmlRequest->get(),
        ]);

        return Response::get($response->getBody()->getContents());
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return new Client([
            'base_uri' => 'http://letsads.com/api',
            'headers' => [
                'Content-Type' => 'text/xml',
            ],
        ]);
    }
}
