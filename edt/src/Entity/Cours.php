<?php
namespace App\Entity;

use App\Repository\CoursRepository;
use App\Validator as Acme; 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
// #[Acme\DateChevauche]

class Cours implements \JsonSerializable
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private ?Salle $salle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $date_heure_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $date_heure_fin = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeur $professeur = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matiere $matiere = null;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: AvisCours::class, orphanRemoval: true)]
    private Collection $avisCours;

    public function __construct()
    {
        $this->avisCours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return sprintf('%s, %s, %s', $this->getMatiere(), $this->getProfesseur(), $this->getSalle());
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'       => $this->getId(),
            'salle'      => $this->getSalle(),
            'dateHeureDebut'   => $this->getDateHeureDebut(),
            'dateHeureFin'    => $this->getDateHeureFin(),
            'type' => $this->getType(),
            'professeur' => strval($this->getProfesseur()),
            'professeur_id' => $this->getProfesseur()->getId(),
            'matiere' => $this->getMatiere(),
        ];
    }

    public function fromArray(array $data): self
    {
        $this->salle = $data['salle'] ?? $this->salle;
        $this->date_heure_debut  = $data['date_heure_debut'] ?? $this->date_heure_debut ;
        $this->date_heure_fin  = $data['date_heure_fin'] ?? $this->date_heure_fin;
        $this->type = $data['type'] ?? $this->type;
        $this->professeur= $data['professeur'] ?? $this->professeur;
        $this->matiere  = $data['matiere'] ?? $this->matiere;
        $this->avisCours = $data['avisCours'] ?? $this->  avisCours  ;

        // $avisCours
        return $this;
    }


    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->date_heure_debut;
    }

    public function setDateHeureDebut(\DateTimeInterface $date_heure_debut): self
    {
        $this->date_heure_debut = $date_heure_debut;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTimeInterface
    {
        return $this->date_heure_fin;
    }

    public function setDateHeureFin(\DateTimeInterface $date_heure_fin): self
    {
        $this->date_heure_fin = $date_heure_fin;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * @return Collection<int, AvisCours>
     */
    public function getAvisCours(): Collection
    {
        return $this->avisCours;
    }

    public function addAvisCour(AvisCours $avisCour): self
    {
        if (!$this->avisCours->contains($avisCour)) {
            $this->avisCours->add($avisCour);
            $avisCour->setCours($this);
        }

        return $this;
    }

    public function removeAvisCour(AvisCours $avisCour): self
    {
        if ($this->avisCours->removeElement($avisCour)) {
            // set the owning side to null (unless already changed)
            if ($avisCour->getCours() === $this) {
                $avisCour->setCours(null);
            }
        }

        return $this;
    }
}
