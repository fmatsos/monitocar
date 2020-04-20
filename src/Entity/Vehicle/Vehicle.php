<?php

/**
 * This file is part of the Monitocar application.
 *
 * Created by Franck Matsos <franck@matsos.fr>
 *
 * Last modified: 18/04/2020 11:19
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace App\Entity\Vehicle;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Vehicle\VehicleRepository")
 */
class Vehicle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public ?int $id;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @Assert\Type(type="digit")
     */
    public ?string $fuelCapacity;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @Assert\Type(type="digit")
     */
    public ?string $fuelConsumption;

    /**
     * @ORM\ManyToOne(targetEntity="FuelType", inversedBy="vehicles")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotNull
     */
    public ?FuelType $fuelType;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @Assert\Type(type="digit")
     */
    public ?string $mileageFromOdometers;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @Assert\Date
     */
    public ?\DateTimeInterface $modelDate;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     */
    public string $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @Assert\Date
     */
    public ?\DateTimeInterface $purchaseDate;

    /**
     * @ORM\OneToMany(targetEntity="Refuelling", mappedBy="vehicle")
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(unique=true)})
     */
    public ?Collection $refuellings;

    public function __construct()
    {
        $this->fuelCapacity = null;
        $this->fuelConsumption = null;
        $this->fuelType = null;
        $this->mileageFromOdometers = null;
        $this->modelDate = null;
        $this->name = '';
        $this->purchaseDate = null;
        $this->refuellings = new ArrayCollection();
    }

    public function addRefuelling(Refuelling $refuelling): void
    {
        $this->refuellings[] = $refuelling;
    }

    public function removeRefuelling(Refuelling $refuelling): void
    {
        $this->refuellings->removeElement($refuelling);
    }
}
