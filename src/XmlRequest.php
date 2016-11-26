<?php

namespace Rhinodontypicus\LetsAds;

use DOMDocument;

class XmlRequest
{
    /**
     * @var DOMDocument
     */
    public $domTree;

    /**
     * Request constructor.
     * @param DOMDocument $domTree
     */
    public function __construct(DOMDocument $domTree)
    {
        $this->domTree = $domTree;
    }

    /**
     * @param $credentials
     * @return XmlRequest
     */
    public static function createRequest($credentials)
    {
        $domTree = new DOMDocument('1.0', 'UTF-8');
        $requestRoot = $domTree->createElement('request');
        $requestRoot = $domTree->appendChild($requestRoot);

        $authRoot = $domTree->createElement('auth');
        $authRoot = $requestRoot->appendChild($authRoot);

        $authRoot->appendChild($domTree->createElement('login', $credentials['login']));
        $authRoot->appendChild($domTree->createElement('password', $credentials['password']));

        return new self($domTree);
    }

    /**
     * @param string $name
     * @param string $value
     * @param null|string $targetNode
     * @return bool
     */
    public function addNode($name, $value = null, $targetNode = null)
    {
        $node = $this->domTree->createElement($name, $value);
        $requestNode = $this->domTree->getElementsByTagName('request')->item(0);

        if (! $targetNode) {
            $requestNode->appendChild($node);
            return true;
        }

        $targetNode = $this->domTree->getElementsByTagName($targetNode)->item(0);
        $targetNode->appendChild($node);

        return true;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->domTree->saveXML(null, LIBXML_NOEMPTYTAG);
    }
}
