<?php

namespace Algolia\SearchApiClient\Client\Service\Command;

use Guzzle\Service\Command\OperationCommand;

class ObjectCreationCommand extends OperationCommand
{
    protected function build()
    {
        if (!empty($this->data['object_id'])) {
            $uri = sprintf('%s/{object_id}', $this->getOperation()->getUri());
            $this
                ->getOperation()
                ->setHttpMethod('PUT')
                ->setUri($uri);
        }

        $this->request = $this->getRequestSerializer()->prepare($this);
    }

    /**
     * Splits objects for batch processing
     *
     * @param array $objects
     * @param string $objectIDKey
     * @return array
     */
    public static function splitObjects(array $objects, $objectIDKey = 'objectID')
    {
        $requests = array();

        foreach ($objects as $object) {
            $request = array('action' => 'addObject', 'body' => $object,);

            if (isset($object[$objectIDKey])) {
                $request['action']   = 'updateObject';
                $request['objectID'] = (string) $object[$objectIDKey];
                unset($request['body'][$objectIDKey]);
            }

            $requests[] = $request;
        }

        return $requests;
    }
}
