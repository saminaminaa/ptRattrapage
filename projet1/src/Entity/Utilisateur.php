<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ApiResource()
 */
class Utilisateur 
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
     * @ORM\OneToMany(targetEntity=Rattrapage::class, mappedBy="surveillant")
     */
    private $rattrapages;


    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->rattrapages = new ArrayCollection();
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

    /**
     * @return Collection|Rattrapage[]
     */
    public function getRattrapages(): Collection
    {
        return $this->rattrapages;
    }

    public function addRattrapage(Rattrapage $rattrapage): self
    {
        if (!$this->rattrapages->contains($rattrapage)) {
            $this->rattrapages[] = $rattrapage;
            $rattrapage->setSurveillant($this);
        }

        return $this;
    }

    public function removeRattrapage(Rattrapage $rattrapage): self
    {
        if ($this->rattrapages->removeElement($rattrapage)) {
            // set the owning side to null (unless already changed)
            if ($rattrapage->getSurveillant() === $this) {
                $rattrapage->setSurveillant(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getUtilisateur() !== $this) {
            $user->setUtilisateur($this);
        }

        $this->user = $user;

        return $this;
    }
}
