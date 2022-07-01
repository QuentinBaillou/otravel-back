<?php

namespace App\Entity;

use App\Repository\LandscapesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LandscapesRepository::class)
 */
class Landscapes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_landscape"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups({"list_landscape"})
     * @Groups({"list_destination"})
     * @Groups({"show_destination"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Destinations::class, mappedBy="landscape")
     */
    private $destinations;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
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
            $destination->addLandscape($this);
        }

        return $this;
    }

    public function removeDestination(Destinations $destination): self
    {
        if ($this->destinations->removeElement($destination)) {
            $destination->removeLandscape($this);
        }

        return $this;
    }
}
