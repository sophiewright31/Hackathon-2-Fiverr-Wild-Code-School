<?php

namespace App\Entity;

use App\Repository\MessageCounterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageCounterRepository::class)
 */
class MessageCounter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $counter;

    /**
     * @ORM\ManyToOne(targetEntity=Content::class, inversedBy="Frequency")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messageCounters")
     */
    private $sender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCounter(): ?int
    {
        return $this->counter;
    }

    public function setCounter(?int $counter): self
    {
        $this->counter = $counter;

        return $this;
    }

    public function getMessage(): ?Content
    {
        return $this->message;
    }

    public function setMessage(?Content $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
