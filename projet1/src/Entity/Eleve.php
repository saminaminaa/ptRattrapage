<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 * @ApiResource()
 */
class Eleve
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @ORM\JoinColumn(nullable=true)
     */
    private $Photo;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="eleves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity=EleveRattrapage::class, mappedBy="eleve")
     */
    private $eleveRattrapages;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Name;

    public function __construct()
    {
        $this->rattrapages = new ArrayCollection();
        $this->eleveRattrapages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection|EleveRattrapage[]
     */
    public function getEleveRattrapages(): Collection
    {
        return $this->eleveRattrapages;
    }

    public function addEleveRattrapage(EleveRattrapage $eleveRattrapage): self
    {
        if (!$this->eleveRattrapages->contains($eleveRattrapage)) {
            $this->eleveRattrapages[] = $eleveRattrapage;
            $eleveRattrapage->setEleve($this);
        }

        return $this;
    }

    public function removeEleveRattrapage(EleveRattrapage $eleveRattrapage): self
    {
        if ($this->eleveRattrapages->removeElement($eleveRattrapage)) {
            // set the owning side to null (unless already changed)
            if ($eleveRattrapage->getEleve() === $this) {
                $eleveRattrapage->setEleve(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }
}
