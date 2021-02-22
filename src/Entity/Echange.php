<?php

namespace App\Entity;

use App\Repository\EchangeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EchangeRepository::class)
 */
class Echange
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="echanges")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Expert::class, inversedBy="echanges")
     */
    private $expert;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="echange")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity=Theme::class, inversedBy="echanges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getExpert(): ?Expert
    {
        return $this->expert;
    }

    public function setExpert(?Expert $expert): self
    {
        $this->expert = $expert;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setEchange($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getEchange() === $this) {
                $message->setEchange(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
