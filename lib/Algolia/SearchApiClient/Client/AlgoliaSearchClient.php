<?php

namespace Algolia\SearchApiClient\Client;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Common\Exception\InvalidArgumentException;

/**
 * Client to interact with Algolia Search
 *
 * @method array listIndexes()
 * @method array deleteIndex(array $parameters)
 * @method array listUserKeys()
 * @method array getUserKeyACL(array $parameters)
 * @method array deleteUserKey()
 * @method array addUserKey(array $parameters)
 * @method array addObject(array $parameters)
 * @method array addObjects(array $parameters)
 * @method array getObject(array $parameters)
 * @method array partialUpdateObject(array $parameters)
 * @method array saveObject(array $parameters)
 * @method array saveObjects()
 * @method array deleteObject()
 * @method array search(array $parameters)
 * @method array getTask(array $parameters)
 * @method array getSettings(array $parameters)
 * @method array setSettings(array $parameters)
 * @method array listIndexUserKeys(array $parameters)
 * @method array getIndexUserKeyACL(array $parameters)
 * @method array deleteIndexUserKey()
 * @method array addIndexUserKey(array $parameters)
 */
class AlgoliaSearchClient extends Client
{
    public static function factory($config = array())
    {
        $required = array(
            'application_id',
            'api_key',
        );

        foreach ($required as $value) {
            if (empty($config[$value])) {
                throw new InvalidArgumentException('Argument "' . $value . '" must not be blank.');
            }
        }

        $default = array(
            'base_url' => sprintf(
                'https://%s-%d.algolia.io/1/',
                $config['application_id'],
                rand(1, 3) // act as kind of a load-balancer
            ),
        );

        $config = Collection::fromConfig($config, $default, $required);

        $client = new self($config->get('base_url'), $config);

        $client->setDefaultOption(
            'headers',
            array(
                'X-Algolia-Application-Id' => $config->get('application_id'),
                'X-Algolia-API-Key'        => $config->get('api_key'),
                'Content-type'             => 'application/json',
            )
        );

        $client->setDescription(ServiceDescription::factory(__DIR__ . '/../Resources/config/client.json'));

        return $client;
    }
}
