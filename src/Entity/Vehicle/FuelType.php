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
 * @ORM\Entity(repositoryClass="App\Repository\Vehicle\FuelTypeRepository")
 */
class FuelType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public ?int $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @Assert\Type(type="string")
     * @Assert\NotNull
     */
    public string $name;

    /**
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="fuelType")
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(unique=true)})
     */
    public ?Collection $vehicles;

    /**
     * @ORM\OneToMany(targetEntity="Refuelling", mappedBy="fuelType")
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(unique=true)})
     */
    public ?Collection $refuellings;

    public function __construct()
    {
        $this->id = null;
        $this->name = '';
        $this->vehicles = new ArrayCollection;
        $this->refuellings = new ArrayCollection;
    }

    public function addVehicle(Vehicle $vehicle): void
    {
        $this->vehicles[] = $vehicle;
    }

    public function removeVehicle(Vehicle $vehicle): void
    {
        $this->vehicles->removeElement($vehicle);
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
