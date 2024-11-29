<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;


#[ORM\Entity(repositoryClass: ClubRepository::class)]

class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 200)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_de_creation = null;

    #[ORM\ManyToOne(targetEntity: Typeclub::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Typeclub $type = null; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDeCreation(): ?\DateTimeInterface
    {
        return $this->date_de_creation;
    }

    public function setDateDeCreation(\DateTimeInterface $date_de_creation): static
    {
        $this->date_de_creation = $date_de_creation;

        return $this;
    }

    public function getType(): ?Typeclub
    {
        return $this->type;
    }

    public function setType(Typeclub $type): self
    {
        $this->type = $type;

        return $this;
    }
}
