<?php

require_once 'Role.php';

class User
{
    private $username;
    private $email;
    private $roles;
    private $password;
    private $id;

    public function __construct(
        string $username,
        string $email,
        array $roles,
        string $password = null,
        string $id = null
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->roles = $roles;

        $this->password = $password;
        $this->id = $id;
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

    public function isAdmin(): bool {
        foreach ($this->roles as $role) {
            if ($role->getName() === ROLE::ROLE_ADMIN) {
                return true;
            }
        }

        return false;
    }

    public function isUser(): bool {
        foreach ($this->roles as $role) {
            if ($role->getName() === ROLE::ROLE_USER) {
                return true;
            }
        }

        return false;
    }
}
