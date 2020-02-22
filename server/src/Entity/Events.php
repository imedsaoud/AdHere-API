<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="Events", indexes={@ORM\Index(name="Events_Federation_FK", columns={"id_Federation"})})
 * @ORM\Entity
 */
class Events
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_start", type="date", nullable=true)
     */
    private $dateStart;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="geo_name", type="string", length=120, nullable=false, options={"fixed"=true})
     */
    private $geoName;

    /**
     * @var float
     *
     * @ORM\Column(name="geo_lat", type="float", precision=10, scale=0, nullable=false)
     */
    private $geoLat;

    /**
     * @var float
     *
     * @ORM\Column(name="geo_lng", type="float", precision=10, scale=0, nullable=false)
     */
    private $geoLng;

    /**
     * @var int
     *
     * @ORM\Column(name="spectator", type="integer", nullable=false)
     */
    private $spectator;

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

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getGeoName(): ?string
    {
        return $this->geoName;
    }

    public function setGeoName(string $geoName): self
    {
        $this->geoName = $geoName;

        return $this;
    }

    public function getGeoLat(): ?float
    {
        return $this->geoLat;
    }

    public function setGeoLat(float $geoLat): self
    {
        $this->geoLat = $geoLat;

        return $this;
    }

    public function getGeoLng(): ?float
    {
        return $this->geoLng;
    }

    public function setGeoLng(float $geoLng): self
    {
        $this->geoLng = $geoLng;

        return $this;
    }

    public function getSpectator(): ?int
    {
        return $this->spectator;
    }

    public function setSpectator(int $spectator): self
    {
        $this->spectator = $spectator;

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
