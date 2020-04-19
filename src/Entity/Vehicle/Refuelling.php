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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Vehicle\RefuellingRepository")
 */
class Refuelling
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicle", inversedBy="refuellings")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotNull
     */
    public Vehicle $vehicle;

    /**
     * @ORM\ManyToOne(targetEntity="FuelType", inversedBy="refuellings")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotNull
     */
    public FuelType $fuelType;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @Assert\Type(type="float")
     */
    public ?float $price;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @Assert\Type(type="float")
     */
    public ?float $quantity;
}
