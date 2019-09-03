<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $task = new Task();
        $task->setTask('Test not set');
        $task->setDueDate(new \DateTime('+ 2 days'));
        $manager->persist($task);

        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('+ 2 days'));
        $task->setConfiguration([
            'parameter3' =>
                [
                    'firstchild'  => 'Sub value 3.1',
                    'secondchild' => 'Sub value 3.2',
                ],
        ]);
        $manager->persist($task);

        $task = new Task();
        $task->setTask('Test not set');
        $task->setDueDate(new \DateTime('+ 2 days'));
        $task->setConfiguration([
            'parameter1' => 'Value 1',
            'parameter2' => 'Value 2',
            'parameter3' =>
                [
                    'firstchild'  => 'Sub value 3.1',
                    'secondchild' => 'Sub value 3.2',
                ],
        ]);
        $manager->persist($task);

        $manager->flush();
    }
}
