<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(attributes={"force_eager"=true})
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="default_cache")
 */
class Task
{
    public const STATUS_CREATED = 0;
    public const STATUS_IN_PROGRESS = 1;
    public const STATUS_SUSPENDED = 2;
    public const STATUS_DONE = 3;
    public const STATUS_CANCELED = 4;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 255
     * )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Assert\NotNull()
     *
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @Assert\NotNull()
     *
     * @ORM\Column(type="datetime")
     */
    private $finish;

    /**
     * @Assert\Range(
     *     min="0",
     *     max="4"
     * )
     *
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @Assert\NotNull()
     * @Assert\Valid()
     *
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="default_cache")
     */
    private $executor;

    /**
     * @Assert\NotNull()
     * @Assert\Valid()
     *
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="default_cache")
     */
    private $project;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?\DateTimeInterface
    {
        return $this->finish;
    }

    public function setFinish(\DateTimeInterface $finish): self
    {
        $this->finish = $finish;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getExecutor(): ?User
    {
        return $this->executor;
    }

    public function setExecutor(?User $executor): self
    {
        $this->executor = $executor;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
