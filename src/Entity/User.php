<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private $id;
    private $username;

    public function __construct(int $id, string $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    // Implement the methods required by UserInterface

    public function getRoles(): array
    {
        // Return an array of roles for the user
        // You can customize this method based on your application's logic
        return ['ROLE_USER'];
    }

    public function getPassword(): string
    {
        // Since you are not using a password field in your User class,
        // you can leave this method empty or return an empty string.
        // It is required to be implemented by the UserInterface.
        return '';
    }

    public function getSalt(): ?string
    {
        // If you are not using a salt for passwords, you can return null.
        // It is required to be implemented by the UserInterface.
        return null;
    }

    public function eraseCredentials(): void
    {
        // If you are storing any sensitive information in the user object,
        // you can clear it out in this method.
        // It is required to be implemented by the UserInterface.
    }

    public function getUserIdentifier(): string
    {
        // Symfony 5.3 introduced a new method getUserIdentifier() to replace getUsername().
        // If you are using Symfony version 5.3 or later, implement this method instead of getUsername().
        // Otherwise, you can use getUsername() and keep getUserIdentifier() empty.
        return $this->getUsername();
    }

    // Getter methods for the id and username properties

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}

