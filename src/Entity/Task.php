<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="task", type="string", length=255, nullable=true)
     */
    protected $task;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="due_date", type="time", nullable=true)
     */
    protected $dueDate;

    /**
     * @var array|null
     *
     * @ORM\Column(name="config", type="json", nullable=true)
     */
    protected $configuration;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

    public function setConfig(?array $config = null)
    {
        $this->configuration = $config;

        return $this;
    }

    public function getConfig(): array
    {
        return $this->configuration ?: [];
    }
}
