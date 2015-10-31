<?php

namespace ToBeDoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TasksController extends Controller
{
    public function indexAction()
    {
        $tasks = $this->getDoctrine()->getRepository('ToBeDoneBundle:Task')
            ->findBy([], ['created' => 'DESC']);

        return $this->render('ToBeDoneBundle:Default:index.html.twig', ['tasks' => $tasks]);
    }

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
}
