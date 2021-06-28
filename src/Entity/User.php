<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
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
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity=Content::class, mappedBy="creator")
     */
    private $contents;

    /**
     * @ORM\OneToMany(targetEntity=Messaging::class, mappedBy="sender")
     */
    private $messagings;

    /**
     * @ORM\OneToMany(targetEntity=Messaging::class, mappedBy="receiver")
     */
    private $messagesReceived;

    /**
     * @ORM\OneToMany(targetEntity=MessageCounter::class, mappedBy="sender")
     */
    private $messageCounters;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="workMate")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    public function __construct()
    {
        $this->contents = new ArrayCollection();
        $this->messagings = new ArrayCollection();
        $this->messagesReceived = new ArrayCollection();
        $this->messageCounters = new ArrayCollection();
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getContents(): Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): self
    {
        if (!$this->contents->contains($content)) {
            $this->contents[] = $content;
            $content->setCreator($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->contents->removeElement($content)) {
            // set the owning side to null (unless already changed)
            if ($content->getCreator() === $this) {
                $content->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Messaging[]
     */
    public function getMessagings(): Collection
    {
        return $this->messagings;
    }

    public function addMessaging(Messaging $messaging): self
    {
        if (!$this->messagings->contains($messaging)) {
            $this->messagings[] = $messaging;
            $messaging->setSender($this);
        }

        return $this;
    }

    public function removeMessaging(Messaging $messaging): self
    {
        if ($this->messagings->removeElement($messaging)) {
            // set the owning side to null (unless already changed)
            if ($messaging->getSender() === $this) {
                $messaging->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Messaging[]
     */
    public function getMessagesReceived(): Collection
    {
        return $this->messagesReceived;
    }

    public function addMessagesReceived(Messaging $messagesReceived): self
    {
        if (!$this->messagesReceived->contains($messagesReceived)) {
            $this->messagesReceived[] = $messagesReceived;
            $messagesReceived->setReceiver($this);
        }

        return $this;
    }

    public function removeMessagesReceived(Messaging $messagesReceived): self
    {
        if ($this->messagesReceived->removeElement($messagesReceived)) {
            // set the owning side to null (unless already changed)
            if ($messagesReceived->getReceiver() === $this) {
                $messagesReceived->setReceiver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MessageCounter[]
     */
    public function getMessageCounters(): Collection
    {
        return $this->messageCounters;
    }

    public function addMessageCounter(MessageCounter $messageCounter): self
    {
        if (!$this->messageCounters->contains($messageCounter)) {
            $this->messageCounters[] = $messageCounter;
            $messageCounter->setSender($this);
        }

        return $this;
    }

    public function removeMessageCounter(MessageCounter $messageCounter): self
    {
        if ($this->messageCounters->removeElement($messageCounter)) {
            // set the owning side to null (unless already changed)
            if ($messageCounter->getSender() === $this) {
                $messageCounter->setSender(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
