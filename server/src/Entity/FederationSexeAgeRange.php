<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FederationSexeAgeRange
 *
 * @ORM\Table(name="federation_sexe_age_range", indexes={@ORM\Index(name="federation_sexe_age_range_Federation_FK", columns={"id_Federation"})})
 * @ORM\Entity(repositoryClass="App\Repository\FederationSexeAgeRangeRepository")
 */
class FederationSexeAgeRange
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
     * @var string
     *
     * @ORM\Column(name="age_range", type="string", length=40, nullable=false)
     */
    private $ageRange;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1, nullable=false)
     */
    private $sexe;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count;

    /**
     * @var \Federation
     *
     * @ORM\ManyToOne(targetEntity="Federation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Federation", referencedColumnName="id")
     * })
     */
    private $idFederation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgeRange(): ?string
    {
        return $this->ageRange;
    }

    public function setAgeRange(string $ageRange): self
    {
        $this->ageRange = $ageRange;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getIdFederation(): ?Federation
    {
        return $this->idFederation;
    }

    public function setIdFederation(?Federation $idFederation): self
    {
        $this->idFederation = $idFederation;

        return $this;
    }


}
