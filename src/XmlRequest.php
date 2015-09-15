<?php

namespace Rhinodontypicus\LetsAds;

use DOMDocument;

class XmlRequest
{
    /**
     * @var DOMDocument
     */
    protected $domTree;

    /**
     * Request constructor.
     * @param $domTree
     */
    public function __construct($domTree)
    {
        $this->domTree = $domTree;
    }

    /**
     * @param $credentials
     * @return XmlRequest
     */
    public static function createRequest($credentials)
    {
        $domTree = new DOMDocument("1.0", "UTF-8");
        $requestRoot = $domTree->createElement("request");
        $requestRoot = $domTree->appendChild($requestRoot);

        $authRoot = $domTree->createElement("auth");
        $authRoot = $requestRoot->appendChild($authRoot);

        $authRoot->appendChild($domTree->createElement("login", $credentials["login"]));
        $authRoot->appendChild($domTree->createElement("password", $credentials["password"]));

        return new self($domTree);
    }

    /**
     * @return bool
     */
    public function addBalanceNode()
    {
        $balance = $this->domTree->createElement("balance");
        $requestNode = $this->domTree->getElementsByTagName("request")->item(0);
        $requestNode->appendChild($balance);
        return true;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->domTree->saveXML();
    }
}
