<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(attributes={"force_eager"=true})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE", region="default_cache")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 255
     * )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 255
     * )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The string '{{ value }}' is not a valid email.",
     *     mode="strict"
     * )
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "The length of email addresses cannot be longer than {{ limit }} characters"
     * )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
