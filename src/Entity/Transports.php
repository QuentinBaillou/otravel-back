<?php

namespace App\Entity;

use App\Repository\TransportsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TransportsRepository::class)
 */
class Transports
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_transport"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"list_transport"})
     * @Groups({"list_destination"})
     * @Groups({"show_destination"})
     */
    private $way;

    /**
     * @ORM\ManyToMany(targetEntity=Destinations::class, mappedBy="transport")
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

    public function getWay(): ?string
    {
        return $this->way;
    }

    public function setWay(string $way): self
    {
        $this->way = $way;

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
            $destination->addTransport($this);
        }

        return $this;
    }

    public function removeDestination(Destinations $destination): self
    {
        if ($this->destinations->removeElement($destination)) {
            $destination->removeTransport($this);
        }

        return $this;
    }
}
