<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StationDistanceEvent
 *
 * @ORM\Table(name="Station_distance_event", indexes={@ORM\Index(name="Station_distance_event_Events0_FK", columns={"id_Events"}), @ORM\Index(name="Station_distance_event_Station_FK", columns={"id_Station"})})
 * @ORM\Entity
 */
class StationDistanceEvent
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
     * @ORM\Column(name="distance_m", type="float", precision=10, scale=0, nullable=false)
     */
    private $distanceM;

    /**
     * @var \Events
     *
     * @ORM\ManyToOne(targetEntity="Events")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Events", referencedColumnName="id")
     * })
     */
    private $idEvents;

    /**
     * @var \Station
     *
     * @ORM\ManyToOne(targetEntity="Station")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Station", referencedColumnName="id")
     * })
     */
    private $idStation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistanceM(): ?float
    {
        return $this->distanceM;
    }

    public function setDistanceM(float $distanceM): self
    {
        $this->distanceM = $distanceM;

        return $this;
    }

    public function getIdEvents(): ?Events
    {
        return $this->idEvents;
    }

    public function setIdEvents(?Events $idEvents): self
    {
        $this->idEvents = $idEvents;

        return $this;
    }

    public function getIdStation(): ?Station
    {
        return $this->idStation;
    }

    public function setIdStation(?Station $idStation): self
    {
        $this->idStation = $idStation;

        return $this;
    }


}
