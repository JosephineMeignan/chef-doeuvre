<?php

namespace App\Entity;

use App\Repository\ProblemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProblemRepository::class)
 */
class Problem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?text
    {
        return $this->content;
    }

    public function setContent(text $content): self
    {
        $this->content = $content;

        return $this;
    }
}
