<?php

namespace Algolia\SearchApiClient\Tests\Client;

use Algolia\SearchApiClient\Client\AlgoliaSearchClient;

class AlgoliaSearchClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $applicationId
     * @param string $apiKey
     *
     * @dataProvider provideConfigValues
     */
    public function testFactoryReturnsClient($applicationId, $apiKey)
    {
        $config = array(
            'application_id' => $applicationId,
            'api_key'        => $apiKey,
        );

        $client  = AlgoliaSearchClient::factory($config);
        $headers = $client->getDefaultOption('headers');

        $this->assertInstanceOf('\Algolia\SearchApiClient\Client\AlgoliaSearchClient', $client);

        $this->assertArrayHasKey('X-Algolia-Application-Id', $headers);
        $this->assertEquals($config['application_id'], $headers['X-Algolia-Application-Id']);

        $this->assertArrayHasKey('X-Algolia-API-Key', $headers);
        $this->assertEquals($config['api_key'], $headers['X-Algolia-API-Key']);

        $this->assertArrayHasKey('Content-type', $headers);
        $this->assertEquals('application/json', $headers['Content-type']);
    }

    /**
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testFactoryReturnsExceptionOnNullArguments()
    {
        $config = array();

        AlgoliaSearchClient::factory($config);
    }

    /**
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     */
    public function testFactoryReturnsExceptionOnBlankArguments()
    {
        $config = array(
            'application_id' => '',
            'api_key'        => '',
        );

        AlgoliaSearchClient::factory($config);
    }

    /**
     * @return array
     */
    public function provideConfigValues()
    {
        return array(
            array('acme', md5('acme'))
        );
    }
}
