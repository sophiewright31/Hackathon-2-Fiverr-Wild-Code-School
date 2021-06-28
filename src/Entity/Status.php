<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsOnline;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="status")
     */
    private $workMate;

    public function __construct()
    {
        $this->workMate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsOnline(): ?bool
    {
        return $this->IsOnline;
    }

    public function setIsOnline(bool $IsOnline): self
    {
        $this->IsOnline = $IsOnline;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getWorkMate(): Collection
    {
        return $this->workMate;
    }

    public function addWorkMate(User $workMate): self
    {
        if (!$this->workMate->contains($workMate)) {
            $this->workMate[] = $workMate;
            $workMate->setStatus($this);
        }

        return $this;
    }

    public function removeWorkMate(User $workMate): self
    {
        if ($this->workMate->removeElement($workMate)) {
            // set the owning side to null (unless already changed)
            if ($workMate->getStatus() === $this) {
                $workMate->setStatus(null);
            }
        }

        return $this;
    }
}
