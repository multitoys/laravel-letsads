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
     * @return \ErrorException|\SimpleXMLElement
     */
    public function balance()
    {
        $xmlRequest = XmlRequest::createRequest($this->credentials);
        $xmlRequest->addNode("balance");

        $response = $this->getClient()->request("POST", "", [
            "body" => $xmlRequest->get()
        ]);

        return Response::get($response->getBody()->getContents());
    }

    /**
     * @param string $message
     * @param string $from
     * @param string|array $recipients
     * @return \ErrorException|\SimpleXMLElement
     */
    public function send($message, $from, $recipients)
    {
        $xmlRequest = XmlRequest::createRequest($this->credentials);
        $xmlRequest->addNode("message");
        $xmlRequest->addNode("from", $from, "message");
        $xmlRequest->addNode("text", $message, "message");

        if (!is_array($recipients)) {
            $xmlRequest->addNode("recipient", $recipients, "message");
        } else {
            foreach ($recipients as $recipient) {
                $xmlRequest->addNode("recipient", $recipient, "message");
            }
        }

        $response = $this->getClient()->request("POST", "", [
            "body" => $xmlRequest->get()
        ]);

        return Response::get($response->getBody()->getContents());
    }

    /**
     * @param string $messageId
     * @return \ErrorException|\SimpleXMLElement
     */
    public function status($messageId)
    {
        $xmlRequest = XmlRequest::createRequest($this->credentials);
        $xmlRequest->addNode("sms_id", $messageId);

        $response = $this->getClient()->request("POST", "", [
            "body" => $xmlRequest->get()
        ]);

        return Response::get($response->getBody()->getContents());
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
