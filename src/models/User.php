<?php

require_once 'Role.php';

class User
{
    private $username;
    private $email;
    private $roles;
    private $password;
    private $id;
    private $createdAt;
    private $roleNames;

    public function __construct(
        string $username,
        string $email,
        array $roles,
        string $password = null,
        string $id = null,
        string $createdAt = null,
        string $roleNames = null
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->roles = $roles;

        $this->password = $password;
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->roleNames = $roleNames;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPassword(): string
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

    public function getRoleNames(): ?string
    {
        return $this->roleNames;
    }

    public function isAdmin(): bool {
        return $this->hasRole(ROLE::ROLE_ADMIN);

    }

    public function isUser(): bool {
        return $this->hasRole(ROLE::ROLE_USER);
    }

    public function hasRole(string $roleName): bool {
        foreach ($this->roles as $role) {
            if ($role->getName() === $roleName) {
                return true;
            }
        }

        return false;
    }
}
