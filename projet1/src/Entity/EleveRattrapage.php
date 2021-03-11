<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EleveRattrapageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EleveRattrapageRepository::class)
 */
class EleveRattrapage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="eleveRattrapages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eleve;

    /**
     * @ORM\ManyToOne(targetEntity=Rattrapage::class, inversedBy="eleveRattrapages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rattrapage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ARendu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Note;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateHeureFin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getRattrapage(): ?Rattrapage
    {
        return $this->rattrapage;
    }

    public function setRattrapage(?Rattrapage $rattrapage): self
    {
        $this->rattrapage = $rattrapage;

        return $this;
    }

    public function getARendu(): ?bool
    {
        return $this->ARendu;
    }

    public function setARendu(bool $ARendu): self
    {
        $this->ARendu = $ARendu;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->Note;
    }

    public function setNote(int $Note): self
    {
        $this->Note = $Note;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTimeInterface
    {
        return $this->DateHeureFin;
    }

    public function setDateHeureFin(\DateTimeInterface $DateHeureFin): self
    {
        $this->DateHeureFin = $DateHeureFin;

        return $this;
    }
}
