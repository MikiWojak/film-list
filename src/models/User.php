<?php

require_once 'Role.php';

class User
{
    private $username;
    private $email;
    private $role;
    private $password;
    private $id;
    private $createdAt;

    public function __construct(
        string $username,
        string $email,
        Role $role,
        string $password = null,
        string $id = null,
        string $createdAt = null,
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;

        $this->password = $password;
        $this->id = $id;
        $this->createdAt = $createdAt;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function isAdmin(): bool {
        return $this->hasRole(ROLE::ROLE_ADMIN);

    }

    public function isUser(): bool {
        return $this->hasRole(ROLE::ROLE_USER);
    }

    public function hasRole(string $roleName): bool {
        return $this->role->getName() === $roleName;
    }
}
