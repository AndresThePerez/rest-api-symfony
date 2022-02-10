<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehicleRepository::class)
 */
class Vehicle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $Id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="float")
     */
    private $Msrp;

    /**
     * @ORM\Column(type="integer")
     */
    private $Year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Make;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Model;
	
	/**
     * @ORM\Column(type="integer")
     */
    private $Miles;
	
	
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Vin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Deleted;

    public function getId(): ?int
    {
        return $this->Id;
    }

    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getMsrp(): ?float
    {
        return $this->Msrp;
    }

    public function setMsrp(float $Msrp): self
    {
        $this->Msrp = $Msrp;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->Year;
    }

    public function setYear(int $Year): self
    {
        $this->Year = $Year;

        return $this;
    }

    public function getMake(): ?string
    {
        return $this->Make;
    }

    public function setMake(string $Make): self
    {
        $this->Make = $Make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(string $Model): self
    {
        $this->Model = $Model;

        return $this;
	}
	
	public function getMiles(): ?int
             {
                 return $this->Miles;
             }

    public function setMiles(int $Miles): self
    {
        $this->Miles = $Miles;

        return $this;
    }
	
    public function setVin(string $Vin): self
    {
        $this->Vin = $Vin;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->Vin;
    }

    public function getDeleted(): ?bool
    {
        return $this->Deleted;
    }

    public function setDeleted(bool $Deleted): self
    {
        $this->Deleted = $Deleted;

        return $this;
    }

	
}
