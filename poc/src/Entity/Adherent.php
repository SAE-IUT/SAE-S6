<?php

namespace App\Entity;

use App\Repository\AdherentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdherentRepository::class)]
class Adherent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAdhesion = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaiss = null;
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $adressePostale = null;

    #[ORM\Column]
    private ?int $numTel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\ManyToMany(targetEntity: Emprunt::class, inversedBy: 'adherents')]
    private Collection $emprunt;

    #[ORM\OneToMany(mappedBy: 'adherent', targetEntity: Reservations::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->emprunt = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAdhesion(): ?\DateTimeInterface
    {
        return $this->dateAdhesion;
    }

    public function setDateAdhesion(\DateTimeInterface $dateAdhesion): static
    {
        $this->dateAdhesion = $dateAdhesion;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

/**
 * @return \DateTimeInterface|null
 */
public function getDateNaiss(): ?\DateTimeInterface
{
    return $this->dateNaiss;
}

/**
 * @param \DateTimeInterface|null $dateNaiss
 */
public function setDateNaiss(?\DateTimeInterface $dateNaiss): static
{
    $this->dateNaiss = $dateNaiss;

    return $this;
}


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAdressePostale(): ?int
    {
        return $this->adressePostale;
    }

    public function setAdressePostale(int $adressePostale): static
    {
        $this->adressePostale = $adressePostale;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    public function setNumTel(int $numTel): static
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, emprunt>
     */
    public function getEmprunt(): Collection
    {
        return $this->emprunt;
    }

    public function addEmprunt(Emprunt $emprunt): static
    {
        if (!$this->emprunt->contains($emprunt)) {
            $this->emprunt->add($emprunt);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): static
    {
        $this->emprunt->removeElement($emprunt);

        return $this;
    }

    /**
     * @return Collection<int, Reservations>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setAdherent($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getAdherent() === $this) {
                $reservation->setAdherent(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
}
