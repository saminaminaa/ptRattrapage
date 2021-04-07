<?php

namespace App\Entity;

use App\Repository\RattrapageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=RattrapageRepository::class)
 * @ApiResource()
 */
class Rattrapage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PDF;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateRattrapage;

    /**
     * @ORM\Column(type="time")
     */
    private $DureeRattrapage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Corrige;

    /**
     * @ORM\Column(type="boolean")
     */
    private $SupportSonore;

    /**
     * @ORM\Column(type="integer")
     */
    private $EtatRattrapage;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="rattrapages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $surveillant;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="rattrapages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $intervenant;

    /**
     * @ORM\OneToMany(targetEntity=EleveRattrapage::class, mappedBy="rattrapage")
     */
    private $eleveRattrapages;

    /**
     * @ORM\ManyToOne(targetEntity=ModuleRattrapage::class, inversedBy="rattrapages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $moduleRattrapage;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="rattrapages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->eleveRattrapages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPDF(): ?string
    {
        return $this->PDF;
    }

    public function setPDF(string $PDF): self
    {
        $this->PDF = $PDF;

        return $this;
    }

    public function getDateRattrapage(): ?\DateTimeInterface
    {
        return $this->DateRattrapage;
    }

    public function setDateRattrapage(\DateTimeInterface $DateRattrapage): self
    {
        $this->DateRattrapage = $DateRattrapage;

        return $this;
    }

    public function getDureeRattrapage(): ?\DateTimeInterface
    {
        return $this->DureeRattrapage;
    }

    public function setDureeRattrapage(\DateTimeInterface $DureeRattrapage): self
    {
        $this->DureeRattrapage = $DureeRattrapage;

        return $this;
    }

    public function getCorrige(): ?string
    {
        return $this->Corrige;
    }

    public function setCorrige(?string $Corrige): self
    {
        $this->Corrige = $Corrige;

        return $this;
    }

    public function getSupportSonore(): ?bool
    {
        return $this->SupportSonore;
    }

    public function setSupportSonore(bool $SupportSonore): self
    {
        $this->SupportSonore = $SupportSonore;

        return $this;
    }

    public function getEtatRattrapage(): ?int
    {
        return $this->EtatRattrapage;
    }

    public function setEtatRattrapage(int $EtatRattrapage): self
    {
        $this->EtatRattrapage = $EtatRattrapage;

        return $this;
    }

    public function getSurveillant(): ?Utilisateur
    {
        return $this->surveillant;
    }

    public function setSurveillant(?Utilisateur $surveillant): self
    {
        $this->surveillant = $surveillant;

        return $this;
    }

    public function getIntervenant(): ?Utilisateur
    {
        return $this->intervenant;
    }

    public function setIntervenant(?Utilisateur $intervenant): self
    {
        $this->intervenant = $intervenant;

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
            $eleveRattrapage->setRattrapage($this);
        }

        return $this;
    }

    public function removeEleveRattrapage(EleveRattrapage $eleveRattrapage): self
    {
        if ($this->eleveRattrapages->removeElement($eleveRattrapage)) {
            // set the owning side to null (unless already changed)
            if ($eleveRattrapage->getRattrapage() === $this) {
                $eleveRattrapage->setRattrapage(null);
            }
        }

        return $this;
    }

    public function getModule(): ?ModuleRattrapage
    {
        return $this->moduleRattrapage;
    }

    public function setModuleRattrapage(?ModuleRattrapage $moduleRattrapage): self
    {
        $this->moduleRattrapage = $moduleRattrapage;

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
}
