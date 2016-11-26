<?php

namespace Rhinodontypicus\LetsAds;

class LetsAds
{
    /**
     * @var LetsAdsGateway
     */
    private $gateway;

    /**
     * @var array
     */
    private $credentials;

    /**
     * LetsAds constructor.
     * @param array $credentials
     * @param LetsAdsGateway $gateway
     */
    public function __construct(array $credentials, LetsAdsGateway $gateway)
    {
        $this->credentials = $credentials;
        $this->gateway = $gateway;
    }

    /**
     * @return XmlRequest
     */
    public function createBalanceXmlRequest()
    {
        $xmlRequest = XmlRequest::createRequest($this->credentials);
        $xmlRequest->addNode('balance', '');

        return $xmlRequest;
    }

    /**
     * @param $messageId
     * @return XmlRequest
     */
    public function createStatusXmlRequest($messageId)
    {
        $xmlRequest = XmlRequest::createRequest($this->credentials);
        $xmlRequest->addNode('sms_id', $messageId);

        return $xmlRequest;
    }

    /**
     * @param $message
     * @param $from
     * @param $recipients
     * @return XmlRequest
     */
    public function createSendXmlRequest($message, $from, $recipients)
    {
        $xmlRequest = XmlRequest::createRequest($this->credentials);
        $xmlRequest->addNode('message');
        $xmlRequest->addNode('from', $from, 'message');
        $xmlRequest->addNode('text', $message, 'message');

        if (! is_array($recipients)) {
            $xmlRequest->addNode('recipient', $recipients, 'message');
        } else {
            foreach ($recipients as $recipient) {
                $xmlRequest->addNode('recipient', $recipient, 'message');
            }
        }

        return $xmlRequest;
    }

    /**
     * @return \ErrorException|\SimpleXMLElement
     */
    public function balance()
    {
        return $this->gateway->request($this->createBalanceXmlRequest());
    }

    /**
     * @param string $message
     * @param string $from
     * @param string|array $recipients
     * @return \ErrorException|\SimpleXMLElement
     */
    public function send($message, $from, $recipients)
    {
        $this->gateway->request($this->createSendXmlRequest($message, $from, $recipients));
    }

    /**
     * @param string $messageId
     * @return \ErrorException|\SimpleXMLElement
     */
    public function status($messageId)
    {
        $this->gateway->request($this->createStatusXmlRequest($messageId));
    }
}
