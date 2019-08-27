<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(EntityManagerInterface $entityManager, TaskRepository $taskRepository)
    {
        $this->entityManager = $entityManager;
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/", name="task_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('task/index.html.twig', [
            'tasks' => $this->taskRepository->findBy([], ['created' => 'DESC']),
        ]);
    }

    /**
     * @Route("task/new", name="task_new_get", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function newGetForm(): \Symfony\Component\HttpFoundation\Response
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        return $this->render('task/edit.html.twig', [
            'form' => $this->createForm(TaskType::class, $task)->createView(),
        ]);
    }

    /**
     * @Route("task/new", name="task_new_post", methods={"POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function newPostForm(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $form = $this->createForm(TaskType::class, new Task());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $task = $form->getData();

            $this->entityManager->persist($task);
            $this->entityManager->flush();

            $this->addFlash('info', 'Task added!');

            return $this->redirectToRoute('task_index');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("task/edit/{id}", name="task_edit_get", methods={"GET"})
     *
     * @param Task $task
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editGet(Task $task): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('task/edit.html.twig', [
            'form' => $this->createForm(TaskType::class, $task)->createView(),
        ]);
    }

    /**
     * @Route("task/edit/{id}", name="task_edit_post", methods={"POST"})
     *
     * @param Request $request
     * @param Task    $task
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editPostForm(Request $request, Task $task): \Symfony\Component\HttpFoundation\Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->entityManager->persist($task);
            $this->entityManager->flush();

            $this->addFlash('info', 'Task updated!');

            return $this->redirectToRoute('task_edit_get', ['id' => $task->getId()]);
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
