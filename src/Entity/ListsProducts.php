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

    // Définition de la relation ManyToOne avec l'entité Lists
    #[ORM\ManyToOne(targetEntity: Lists::class, inversedBy: 'listsProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lists $list = null;

    // Définition de la relation ManyToOne avec l'entité Products
    #[ORM\ManyToOne(targetEntity: Products::class, inversedBy: 'listsProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter et Setter pour la liste
    public function getList(): ?Lists
    {
        return $this->list;
    }

    public function setList(?Lists $list): static
    {
        $this->list = $list;

        return $this;
    }

    // Getter et Setter pour le produit
    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): static
    {
        $this->product = $product;

        return $this;
    }
}
