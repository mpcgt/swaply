<?php

namespace App\Entity;

use App\Repository\ListsProductsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListsProductsRepository::class)]
class ListsProducts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $lists_id = null;

    #[ORM\Column]
    private ?int $products_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListsId(): ?int
    {
        return $this->lists_id;
    }

    public function setListsId(int $lists_id): static
    {
        $this->lists_id = $lists_id;

        return $this;
    }

    public function getProductsId(): ?int
    {
        return $this->products_id;
    }

    public function setProductsId(int $products_id): static
    {
        $this->products_id = $products_id;

        return $this;
    }
}
