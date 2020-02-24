<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Station
 *
 * @ORM\Table(name="Station")
 * @ORM\Entity(repositoryClass="App\Repository\StationRepository")
 */
class Station
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
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true, options={"fixed"=true})
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="lt", type="float", precision=10, scale=0, nullable=false)
     */
    private $lt;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float", precision=10, scale=0, nullable=false)
     */
    private $lng;

    /**
     * @var int
     *
     * @ORM\Column(name="affluence", type="integer", nullable=false)
     */
    private $affluence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLt(): ?float
    {
        return $this->lt;
    }

    public function setLt(float $lt): self
    {
        $this->lt = $lt;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getAffluence(): ?int
    {
        return $this->affluence;
    }

    public function setAffluence(int $affluence): self
    {
        $this->affluence = $affluence;

        return $this;
    }


}
