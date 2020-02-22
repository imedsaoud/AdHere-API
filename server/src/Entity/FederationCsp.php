<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FederationCsp
 *
 * @ORM\Table(name="federation_csp")
 * @ORM\Entity
 */
class FederationCsp
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="ouvrier", type="float", precision=10, scale=0, nullable=false)
     */
    private $ouvrier;

    /**
     * @var float
     *
     * @ORM\Column(name="agriculteur", type="float", precision=10, scale=0, nullable=false)
     */
    private $agriculteur;

    /**
     * @var float
     *
     * @ORM\Column(name="inactif", type="float", precision=10, scale=0, nullable=false)
     */
    private $inactif;

    /**
     * @var float
     *
     * @ORM\Column(name="employe", type="float", precision=10, scale=0, nullable=false)
     */
    private $employe;

    /**
     * @var float
     *
     * @ORM\Column(name="retraite", type="float", precision=10, scale=0, nullable=false)
     */
    private $retraite;

    /**
     * @var float
     *
     * @ORM\Column(name="cadre", type="float", precision=10, scale=0, nullable=false)
     */
    private $cadre;

    /**
     * @var float
     *
     * @ORM\Column(name="profinter", type="float", precision=10, scale=0, nullable=false)
     */
    private $profinter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOuvrier(): ?float
    {
        return $this->ouvrier;
    }

    public function setOuvrier(float $ouvrier): self
    {
        $this->ouvrier = $ouvrier;

        return $this;
    }

    public function getAgriculteur(): ?float
    {
        return $this->agriculteur;
    }

    public function setAgriculteur(float $agriculteur): self
    {
        $this->agriculteur = $agriculteur;

        return $this;
    }

    public function getInactif(): ?float
    {
        return $this->inactif;
    }

    public function setInactif(float $inactif): self
    {
        $this->inactif = $inactif;

        return $this;
    }

    public function getEmploye(): ?float
    {
        return $this->employe;
    }

    public function setEmploye(float $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    public function getRetraite(): ?float
    {
        return $this->retraite;
    }

    public function setRetraite(float $retraite): self
    {
        $this->retraite = $retraite;

        return $this;
    }

    public function getCadre(): ?float
    {
        return $this->cadre;
    }

    public function setCadre(float $cadre): self
    {
        $this->cadre = $cadre;

        return $this;
    }

    public function getProfinter(): ?float
    {
        return $this->profinter;
    }

    public function setProfinter(float $profinter): self
    {
        $this->profinter = $profinter;

        return $this;
    }


}
