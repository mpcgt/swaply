<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_products = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $id_category = null;

    #[ORM\Column]
    private ?int $id_badge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProducts(): ?int
    {
        return $this->id_products;
    }

    public function setIdProducts(int $id_products): static
    {
        $this->id_products = $id_products;

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

    public function getIdCategory(): ?int
    {
        return $this->id_category;
    }

    public function setIdCategory(int $id_category): static
    {
        $this->id_category = $id_category;

        return $this;
    }

    public function getIdBadge(): ?int
    {
        return $this->id_badge;
    }

    public function setIdBadge(int $id_badge): static
    {
        $this->id_badge = $id_badge;

        return $this;
    }
}
