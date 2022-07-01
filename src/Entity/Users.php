<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=250)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity=Destinations::class, mappedBy="user")
     */
    private $destinations;

    /**
     * @ORM\ManyToMany(targetEntity=Nights::class, inversedBy="user")
     */
    private $night;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
        $this->night = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Destinations>
     */
    public function getDestinations(): Collection
    {
        return $this->destinations;
    }

    public function addDestination(Destinations $destination): self
    {
        if (!$this->destinations->contains($destination)) {
            $this->destinations[] = $destination;
            $destination->addUser($this);
        }

        return $this;
    }

    public function removeDestination(Destinations $destination): self
    {
        if ($this->destinations->removeElement($destination)) {
            $destination->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Nights>
     */
    public function getNight(): Collection
    {
        return $this->night;
    }

    public function addNight(Nights $night): self
    {
        if (!$this->night->contains($night)) {
            $this->night[] = $night;
        }

        return $this;
    }

    public function removeNight(Nights $night): self
    {
        $this->night->removeElement($night);

        return $this;
    }
}
