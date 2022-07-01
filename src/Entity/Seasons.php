<?php

namespace App\Entity;

use App\Repository\SeasonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SeasonsRepository::class)
 */
class Seasons
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_season"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups({"show_destination"})
     * @Groups({"list_season"})
     * @Groups({"list_destination"})
     */
    private $season;

    /**
     * @ORM\ManyToMany(targetEntity=Destinations::class, mappedBy="season")
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

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;

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
            $destination->addSeason($this);
        }

        return $this;
    }

    public function removeDestination(Destinations $destination): self
    {
        if ($this->destinations->removeElement($destination)) {
            $destination->removeSeason($this);
        }

        return $this;
    }
}
