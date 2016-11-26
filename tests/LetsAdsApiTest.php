<?php

namespace Rhinodontypicus\LetsAds\Test;

class LetsAdsApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_create_proper_auth_and_balance_xml_request()
    {
        $xmlRequest = app('letsads')->createBalanceXmlRequest();

        $excepted = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<request><auth><login>login</login><password>password</password></auth><balance/></request>\n
EOT;

        $this->assertEquals($excepted, $xmlRequest->get());
    }

    /**
     * @test
     */
    public function it_create_status_xml_request()
    {
        $xmlRequest = app('letsads')->createStatusXmlRequest(1);

        $excepted = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<request><auth><login>login</login><password>password</password></auth><sms_id>1</sms_id></request>\n
EOT;

        $this->assertEquals($excepted, $xmlRequest->get());
    }

    /**
     * @test
     */
    public function it_create_send_xml_request()
    {
        $xmlRequest = app('letsads')->createSendXmlRequest('Text', 'Sender', 123);

        $excepted = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<request><auth><login>login</login><password>password</password></auth><message><from>Sender</from><text>Text</text><recipient>123</recipient></message></request>\n
EOT;

        $this->assertEquals($excepted, $xmlRequest->get());
    }

    /**
     * @test
     */
    public function it_create_send_xml_request_for_multiple_recipients()
    {
        $xmlRequest = app('letsads')->createSendXmlRequest('Text', 'Sender', [123, 456]);

        $excepted = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<request><auth><login>login</login><password>password</password></auth><message><from>Sender</from><text>Text</text><recipient>123</recipient><recipient>456</recipient></message></request>\n
EOT;

        $this->assertEquals($excepted, $xmlRequest->get());
    }
}