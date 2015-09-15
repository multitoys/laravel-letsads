<?php

namespace Rhinodontypicus\LetsAds;

use \GuzzleHttp\Client;

/**
 * Class LetsAds
 * @package Rhinodontypicus\LetsAds
 */

class LetsAds
{
    /**
     * @var array
     */
    protected $credentials;

    /**
     * LetsAds constructor.
     * @param array $credentials
     */
    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function balance()
    {
        $xmlRequest = XmlRequest::createRequest($this->credentials);
        $xmlRequest->addBalanceNode();

        $response = $this->getClient()->request("POST", "", [
            "body" => $xmlRequest->get()
        ]);

        return $response;
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return new Client([
            "base_uri" => "http://letsads.com/api",
            "headers" => [
                "Content-Type" => "text/xml"
            ]
        ]);
    }
}
