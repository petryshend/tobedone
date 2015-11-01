<?php

namespace ToBeDoneBundle\Tests\Utils;

use ToBeDoneBundle\Entity\Task;
use ToBeDoneBundle\Utils\Utils;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    /** @var Utils */
    private $SUT;

    public function setUp()
    {
        $this->SUT = new Utils();
    }

    public function testSplitTasksByDays()
    {
        $actual= $this->SUT->splitTasksByDays($this->prepareTasks());

        $this->assertEquals($this->prepareExpected(), $actual);
    }

    /**
     * @return Task[]
     */
    private function prepareTasks()
    {
        $task1 = new Task();
        $task1->setBody('task body');
        $task1->setIsDone(false);
        $task1->setCreated(new \DateTime('2015-10-31 10:56:36.0'));

        $task2 = new Task();
        $task2->setBody('task body');
        $task2->setIsDone(false);
        $task2->setCreated(new \DateTime('2015-10-31 10:56:36.0'));

        $task3 = new Task();
        $task3->setBody('task body');
        $task3->setIsDone(false);
        $task3->setCreated(new \DateTime('2015-10-30 10:56:36.0'));

        $task4 = new Task();
        $task4->setBody('task body');
        $task4->setIsDone(false);
        $task4->setCreated(new \DateTime('2015-10-30 10:56:36.0'));

        $task5 = new Task();
        $task5->setBody('task body');
        $task5->setIsDone(false);
        $task5->setCreated(new \DateTime('2015-10-15 10:56:36.0'));

        return [$task1, $task2, $task3, $task4, $task5];
    }

    /**
     * @return array
     */
    private function prepareExpected()
    {
        $tasks = $this->prepareTasks();

        return [
            '2015-10-31' => [$tasks[0], $tasks[1]],
            '2015-10-30' => [$tasks[2], $tasks[3]],
            '2015-10-15' => [$tasks[4]],
        ];
    }
}