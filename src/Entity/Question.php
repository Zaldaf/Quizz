<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intituler = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Theme $Theme = null;

    #[ORM\ManyToMany(targetEntity: Reponse::class, mappedBy: 'Question')]
    private Collection $reponses;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntituler(): ?string
    {
        return $this->intituler;
    }

    public function setIntituler(string $intituler): self
    {
        $this->intituler = $intituler;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->Theme;
    }

    public function setTheme(?Theme $Theme): self
    {
        $this->Theme = $Theme;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->addQuestion($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            $reponse->removeQuestion($this);
        }

        return $this;
    }
}
