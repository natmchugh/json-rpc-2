<?php

namespace Ndm\JsonRpc2\Client\Transport;

class SocketTransportTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->client = new SocketTransport();
    }

    public function testNothing() 
    {
        $this->markTestIncomplete();
    }
}