<?php

namespace Anax\Response;

/**
 * Test cases for class Guess.
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateObject()
    {
        $response = new Response();
        $this->assertInstanceOf("\Anax\Response\Response", $response);

        $response->setStatusCode(200);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
