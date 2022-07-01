<?php

namespace App\Entity;

use App\Repository\NightsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NightsRepository::class)
 */
class Nights
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $night_nb;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, mappedBy="night")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Destinations::class, mappedBy="nigth")
     */
    private $destinations;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="night")
     */
    private $users;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->destinations = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNightNb(): ?int
    {
        return $this->night_nb;
    }

    public function setNightNb(int $night_nb): self
    {
        $this->night_nb = $night_nb;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->addNight($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->user->removeElement($user)) {
            $user->removeNight($this);
        }

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
            $destination->addNigth($this);
        }

        return $this;
    }

    public function removeDestination(Destinations $destination): self
    {
        if ($this->destinations->removeElement($destination)) {
            $destination->removeNigth($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
}
