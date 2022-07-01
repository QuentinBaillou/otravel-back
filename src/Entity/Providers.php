<?php

namespace App\Entity;

use App\Repository\ProvidersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProvidersRepository::class)
 */
class Providers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=Destinations::class, mappedBy="provider")
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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
            $destination->setProvider($this);
        }

        return $this;
    }

    public function removeDestination(Destinations $destination): self
    {
        if ($this->destinations->removeElement($destination)) {
            // set the owning side to null (unless already changed)
            if ($destination->getProvider() === $this) {
                $destination->setProvider(null);
            }
        }

        return $this;
    }
}
