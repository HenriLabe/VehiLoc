<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?bool $motor = null;

    #[ORM\Column]
    #[Assert\Type('INTEGER')]
    #[Assert\Range(['min' => 1, 'max' => 9])]
    private ?int $placeNumber = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank()]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?float $pricePerDay = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?float $pricePerMonth = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isManual(): ?bool
    {
        return $this->motor;
    }

    public function setManual(bool $isManual): static
    {
        $this->motor = $isManual;

        return $this;
    }

    public function getPlaceNumber(): ?int
    {
        return $this->placeNumber;
    }

    public function setPlaceNumber(int $placeNumber): static
    {
        $this->placeNumber = $placeNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPricePerDay(): ?float
    {
        return $this->pricePerDay;
    }

    public function setPricePerDay(float $pricePerDay): static
    {
        $this->pricePerDay = $pricePerDay;

        return $this;
    }

    public function getPricePerMonth(): ?float
    {
        return $this->pricePerMonth;
    }

    public function setPricePerMonth(float $pricePerMonth): static
    {
        $this->pricePerMonth = $pricePerMonth;

        return $this;
    }
    public function getMotor(): ?bool
    {
        return $this->motor;
    }

    public function setMotor(?bool $motor): void
    {
        $this->motor = $motor;
    }

}
