<?php

namespace ToBeDoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use ToBeDoneBundle\Entity\Task;
use ToBeDoneBundle\Form\Type\TaskType;

class TasksController extends Controller
{
    public function indexAction()
    {
        $tasks = $this->getDoctrine()->getRepository('ToBeDoneBundle:Task')
            ->findBy([], ['created' => 'DESC']);

        $newTask = new Task();
        $newTaskForm = $this->createForm(
            new TaskType(),
            $newTask,
            [
                'action' => $this->generateUrl('to_be_done_new_task'),
                'method' => 'POST',
            ]
        );

        return $this->render(
            'ToBeDoneBundle:Default:index.html.twig',
            [
                'tasks' => $this->get('to_be_done.utils')->splitTasksByDays($tasks),
                'newTaskForm' => $newTaskForm->createView(),
            ]
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->persistTask($task);
            return $this->redirectToRoute('to_be_done_homepage');
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function setDoneAction(Request $request)
    {
        $taskId = $request->get('task_id');
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('ToBeDoneBundle:Task')->find($taskId);

        if (!$task) {
            throw $this->createNotFoundException('No task found with id ' . $taskId);
        }

        $task->setIsDone(true);
        $em->flush();

        return $this->redirectToRoute('to_be_done_homepage');
    }

    /**
     * @param Task $task
     */
    private function persistTask(Task $task)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
    }
}
