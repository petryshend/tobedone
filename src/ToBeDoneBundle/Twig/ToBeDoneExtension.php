<?php

namespace ToBeDoneBundle\Twig;

use ToBeDoneBundle\Entity\Task;

class ToBeDoneExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('doneTasks', [$this, 'tasksDoneFilter']),
        ];
    }

    /**
     * @param Task[] $tasks
     * @param bool|true $done
     * @return Task[]
     */
    public function tasksDoneFilter($tasks, $done = true)
    {
        return array_filter($tasks, function($task) use ($done) {
            /** @var Task $task */
            if ($done) {
                return $task->getIsDone();
            }
            return !$task->getIsDone();
        });
    }

    public function getName()
    {
        return 'tobedone_extension';
    }
}