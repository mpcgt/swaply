<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface; // Correction ici
use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $id_users;

    #[ORM\Column(length: 50)]
    private ?string $first_name = null;

    #[ORM\Column(length: 50)]
    private ?string $last_name = null;

    #[ORM\Column(length: 50)]
    private string $username;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password_hash = null;

    #[ORM\Column]
    private bool $is_admin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsers(): ?int
    {
        return $this->id_users;
    }

    public function setIdUsers(int $id_users): static
    {
        $this->id_users = $id_users;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswordHash(): ?string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password_hash): static
    {
        $this->password_hash = $password_hash;

        return $this;
    }

    public function isAdmin(): ?bool
    {
        return $this->is_admin;
    }

    public function setIsAdmin(bool $is_admin): self
    {
        $this->is_admin = $is_admin;

        return $this;
    }

    // Implémentation de getRoles() (nécessaire pour UserInterface)
    public function getRoles(): array
    {
        // Assurez-vous de renvoyer un tableau de rôles
        // Exemple : ['ROLE_USER', 'ROLE_ADMIN'] 
        $roles = $this->is_admin ? ['ROLE_ADMIN'] : ['ROLE_USER'];
        return $roles;
    }

    // Implémentation de getUserIdentifier() (nécessaire pour UserInterface)
    public function getUserIdentifier(): string
    {
        // Ici, on retourne l'email ou le username comme identifiant unique
        return $this->email;  // ou return $this->username;
    }

    // Implémentation de eraseCredentials() (nécessaire pour UserInterface)
    public function eraseCredentials(): void
    {
        // Si vous avez des informations sensibles à effacer, vous pouvez le faire ici.
        // Par exemple, un mot de passe temporaire.
    }

    // Implémentation de PasswordAuthenticatedUserInterface
    public function getPassword(): string
    {
        return $this->getPasswordHash(); // Retourne le mot de passe haché
    }
}
