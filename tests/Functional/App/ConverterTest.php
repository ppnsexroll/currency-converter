<?php

namespace Tests\Functional\App;

class ConverterTest extends BaseTestCase
{

    public function testPostConvertWithBodyEmpty()
    {
        $response = $this->runApp('POST', '/converter');
        $body = $this->getParsedResponseBodyToJson($response);
        $this->assertEquals($response->getStatusCode(), 400);
        $this->assertArrayHasKey('status', $body);
        $this->assertArrayHasKey( 'error', $body);
        $this->assertEquals($body['status'], false);
        $this->assertEquals($body['error'], 'The body cannot be empty');
    }

    public function testPostConvetWithInvalidFromField()
    {
        $postData = [
            'currency' => 'ARN',
            'to' => 'USD',
            'amount' => 1
        ];
        $response = $this->runApp('POST', '/converter', $postData);
        $body = $this->getParsedResponseBodyToJson($response);
        $this->assertEquals($response->getStatusCode(), 400);
        $this->assertArrayHasKey('status', $body);
        $this->assertArrayHasKey( 'error', $body);
        $this->assertEquals($body['status'], false);
        $this->assertEquals($body['error'], 'The From is required');
    }

    public function testPostConvetWithInvalidToField()
    {
        $postData = [
            'from' => 'USD',
            'currency' => 'USD',
            'amount' => 1
        ];
        $response = $this->runApp('POST', '/converter', $postData);
        $body = $this->getParsedResponseBodyToJson($response);
        $this->assertEquals($response->getStatusCode(), 400);
        $this->assertArrayHasKey('status', $body);
        $this->assertArrayHasKey( 'error', $body);
        $this->assertEquals($body['status'], false);
        $this->assertEquals($body['error'], 'The To is required');
    }


    public function testPostConvetWithInvalidCurrenciesValue()
    {
        $postData = [
            'from' => 'USD',
            'to' => 'USD',
            'amount' => 1
        ];
        $response = $this->runApp('POST', '/converter', $postData);
        $body = $this->getParsedResponseBodyToJson($response);
        $this->assertEquals($response->getStatusCode(), 400);
        $this->assertArrayHasKey('status', $body);
        $this->assertArrayHasKey( 'error', $body);
        $this->assertEquals($body['status'], false);
        $this->assertEquals($body['error'], 'The currencies cannot be equals');
    }

    public function testPostConvetWithInvalidAmountField()
    {
        $postData = [
            'from' => 'USD',
            'to' => 'USD'
        ];
        $response = $this->runApp('POST', '/converter', $postData);
        $body = $this->getParsedResponseBodyToJson($response);
        $this->assertEquals($response->getStatusCode(), 400);
        $this->assertArrayHasKey('status', $body);
        $this->assertArrayHasKey( 'error', $body);
        $this->assertEquals($body['status'], false);
        $this->assertEquals($body['error'], 'The Amount is required');
    }

    public function testPostConvetWithInvalidAmountValue()
    {
        $postData = [
            'from' => 'USD',
            'to' => 'USD',
            'amount' => 0
        ];
        $response = $this->runApp('POST', '/converter', $postData);
        $body = $this->getParsedResponseBodyToJson($response);
        $this->assertEquals($response->getStatusCode(), 400);
        $this->assertArrayHasKey('status', $body);
        $this->assertArrayHasKey( 'error', $body);
        $this->assertEquals($body['status'], false);
        $this->assertEquals($body['error'], 'The Amount minimum is 1');
    }

//    public function testGetHomepageWithoutName()
//    {
//        $response = $this->runApp('POST', '/converter');
//        $body = $this->getParsedResponseBodyToJson($response);
//        var_dump($body);
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertContains('SlimFramework', (string)$response->getBody());
//        $this->assertNotContains('Hello', (string)$response->getBody());
//    }

//    /**
//     * Test that the index route with optional name argument returns a rendered greeting
//     */
//    public function testGetHomepageWithGreeting()
//    {
//        $response = $this->runApp('GET', '/name');
//
//        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertContains('Hello name!', (string)$response->getBody());
//    }
//
//    /**
//     * Test that the index route won't accept a post request
//     */
//    public function testPostHomepageNotAllowed()
//    {
//        $response = $this->runApp('POST', '/', ['test']);
//
//        $this->assertEquals(405, $response->getStatusCode());
//        $this->assertContains('Method not allowed', (string)$response->getBody());
//    }
}