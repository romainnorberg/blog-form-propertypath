<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\PropertyAccess\PropertyAccess;

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
     * @ORM\Column(name="task", type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank
     */
    protected $task;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="due_date", type="datetime", nullable=false)
     *
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */
    protected $dueDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     *
     */
    protected $created;

    /**
     * @var array|null
     *
     * @ORM\Column(name="config", type="json", nullable=true)
     */
    protected $configuration;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId(): \Ramsey\Uuid\UuidInterface
    {
        return $this->id;
    }

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

    public function setConfiguration($configuration = null)
    {
        if ($configuration instanceof self) {
            $configuration = $configuration->getConfiguration();
        }

        $this->configuration = $configuration;

        return $this;
    }

    public function getConfiguration(): array
    {
        return $this->configuration ?: [];
    }

    public function getConfigurationParameter(string $parameter)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        return $propertyAccessor->getValue($this->configuration, $parameter);
    }
}
