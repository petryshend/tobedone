<?php

namespace ToBeDoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TasksController extends Controller
{
    public function indexAction()
    {
        $tasks = $this->getDoctrine()->getRepository('ToBeDoneBundle:Task')->findAll();

        return $this->render('ToBeDoneBundle:Default:index.html.twig', ['tasks' => $tasks]);
    }
}
