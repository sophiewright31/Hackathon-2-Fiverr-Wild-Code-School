<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContentRepository::class)
 */
class Content
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="contents")
     */
    private $creator;

    /**
     * @ORM\ManyToMany(targetEntity=Messaging::class, mappedBy="content")
     */
    private $yes;

    /**
     * @ORM\OneToMany(targetEntity=MessageCounter::class, mappedBy="message")
     */
    private $Frequency;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
        $this->Frequency = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): self
    {
        $this->Message = $Message;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection|Messaging[]
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Messaging $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes[] = $ye;
            $ye->addContent($this);
        }

        return $this;
    }

    public function removeYe(Messaging $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            $ye->removeContent($this);
        }

        return $this;
    }

    /**
     * @return Collection|MessageCounter[]
     */
    public function getFrequency(): Collection
    {
        return $this->Frequency;
    }

    public function addFrequency(MessageCounter $frequency): self
    {
        if (!$this->Frequency->contains($frequency)) {
            $this->Frequency[] = $frequency;
            $frequency->setMessage($this);
        }

        return $this;
    }

    public function removeFrequency(MessageCounter $frequency): self
    {
        if ($this->Frequency->removeElement($frequency)) {
            // set the owning side to null (unless already changed)
            if ($frequency->getMessage() === $this) {
                $frequency->setMessage(null);
            }
        }

        return $this;
    }
}
