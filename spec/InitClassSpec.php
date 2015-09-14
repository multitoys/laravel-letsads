<?php

namespace spec\Rhinodontypicus\LetsAds;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InitClassSpec extends ObjectBehavior
{
    /**
     * @test
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Rhinodontypicus\LetsAds\InitClass');
    }

    /**
     * @test
     */
    function it_echo_phrase()
    {
        $this->echoPhrase('Hello, World!')->shouldReturn('Hello, World!');
    }
}
