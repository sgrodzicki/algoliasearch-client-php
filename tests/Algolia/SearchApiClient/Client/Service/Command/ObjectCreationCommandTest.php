<?php

namespace Algolia\SearchApiClient\Tests\Client\Service\Command;

use Algolia\SearchApiClient\Client\Service\Command\ObjectCreationCommand;

class ObjectCreationCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideSampleObjects
     */
    public function testSplittingObjects(array $actual, array $expected)
    {
        $this->assertEquals($expected, ObjectCreationCommand::splitObjects($actual));
    }

    /**
     * @return array
     */
    public function provideSampleObjects()
    {
        return array(
            array(
                array(
                    array(
                        'firstname' => 'Jimmie',
                        'lastname'  => 'Barninger',
                    ),
                    array(
                        'firstname' => 'Warren',
                        'lastname'  => 'myID1',
                    ),
                ),
                array(
                    array(
                        'action' => 'addObject',
                        'body'   => array(
                            'firstname' => 'Jimmie',
                            'lastname'  => 'Barninger',
                        ),
                    ),
                    array(
                        'action' => 'addObject',
                        'body'   => array(
                            'firstname' => 'Warren',
                            'lastname'  => 'myID1',
                        ),
                    ),
                ),
            ),
            array(
                array(
                    array(
                        'firstname' => 'Jimmie',
                        'lastname'  => 'Barninger',
                        'objectID'  => 'SFO',
                    ),
                    array(
                        'firstname' => 'Warren',
                        'lastname'  => 'Speach',
                        'objectID'  => 'myID2',
                    ),
                ),
                array(
                    array(
                        'action'   => 'updateObject',
                        'objectID' => 'SFO',
                        'body'     => array(
                            'firstname' => 'Jimmie',
                            'lastname'  => 'Barninger',
                        ),
                    ),
                    array(
                        'action'   => 'updateObject',
                        'objectID' => 'myID2',
                        'body'     => array(
                            'firstname' => 'Warren',
                            'lastname'  => 'Speach',
                        ),
                    ),
                ),
            ),
            array(
                array(
                    array(
                        'firstname' => 'Jimmie',
                        'lastname'  => 'Barninger',
                    ),
                    array(
                        'firstname' => 'Jimmie',
                        'lastname'  => 'Barninger',
                        'objectID'  => 'SFO',
                    ),
                    array(
                        'firstname' => 'Warren',
                        'lastname'  => 'myID1',
                    ),
                    array(
                        'firstname' => 'Warren',
                        'lastname'  => 'Speach',
                        'objectID'  => 'myID2',
                    ),
                ),
                array(
                    array(
                        'action' => 'addObject',
                        'body'   => array(
                            'firstname' => 'Jimmie',
                            'lastname'  => 'Barninger',
                        ),
                    ),
                    array(
                        'action'   => 'updateObject',
                        'objectID' => 'SFO',
                        'body'     => array(
                            'firstname' => 'Jimmie',
                            'lastname'  => 'Barninger',
                        ),
                    ),
                    array(
                        'action' => 'addObject',
                        'body'   => array(
                            'firstname' => 'Warren',
                            'lastname'  => 'myID1',
                        ),
                    ),
                    array(
                        'action'   => 'updateObject',
                        'objectID' => 'myID2',
                        'body'     => array(
                            'firstname' => 'Warren',
                            'lastname'  => 'Speach',
                        ),
                    ),
                ),
            ),
        );
    }
}
