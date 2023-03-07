<?php

namespace App\Entity;

use App\Repository\AvisCoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisCoursRepository::class)]
class AvisCours implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $emailEtudiant = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'avisCours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cours $cours = null;

    public function jsonSerialize(): mixed
    {
        return [
            'id'            => $this->getId(),
            'note'          => $this->getNote(),
            'commentaire'   => $this->getCommentaire(),
            'emailEtudiant' => $this->getEmailEtudiant(),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getEmailEtudiant(): ?string
    {
        return $this->emailEtudiant;
    }

    public function setEmailEtudiant(string $emailEtudiant): self
    {
        $this->emailEtudiant = $emailEtudiant;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getCours(): ?cours
    {
        return $this->cours;
    }

    public function setCours(?cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }
}
