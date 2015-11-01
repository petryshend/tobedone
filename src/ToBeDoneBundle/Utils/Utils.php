<?php

namespace ToBeDoneBundle\Utils;

use ToBeDoneBundle\Entity\Task;

class Utils
{
    /**
     * @param Task[] $tasks
     * @return array
     */
    public function splitTasksByDays($tasks)
    {
        $result = [];
        foreach ($tasks as $task) {
            $dateKey = $task->getCreated()->format('Y-m-d');
            if (array_key_exists($dateKey, $result)) {
                $result[$dateKey][] = $task;
            } else {
                $result[$dateKey] = [$task];
            }
        }

        return $result;
    }
}