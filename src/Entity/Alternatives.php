<?php

namespace App\Entity;

use App\Repository\AlternativesRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Products;

#[ORM\Entity(repositoryClass: AlternativesRepository::class)]
class Alternatives
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Products::class)]
    #[ORM\JoinColumn(name: "id_products", referencedColumnName: "id", nullable: false)]
    private ?Products $product = null;

    #[ORM\ManyToOne(targetEntity: Products::class)]
    #[ORM\JoinColumn(name: "id_alternatives", referencedColumnName: "id", nullable: false)]
    private ?Products $alternative = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $advantage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $incovenient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getAlternative(): ?Products
    {
        return $this->alternative;
    }

    public function setAlternative(?Products $alternative): static
    {
        $this->alternative = $alternative;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAdvantage(): ?string
    {
        return $this->advantage;
    }

    public function setAdvantage(?string $advantage): static
    {
        $this->advantage = $advantage;

        return $this;
    }

    public function getIncovenient(): ?string
    {
        return $this->incovenient;
    }

    public function setIncovenient(?string $incovenient): static
    {
        $this->incovenient = $incovenient;

        return $this;
    }
}