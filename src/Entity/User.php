<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="User")
 */
class User
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     */
    private $login;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     */
    private $password;


    public function __construct()
    {
    
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}