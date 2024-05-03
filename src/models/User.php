<?php

class User
{
    private $username;
    private $email;
    private $password;
    private $id;

    public function __construct(
        string $username,
        string $email,
        string $password = null,
        string $id = null
    ) {
        $this->username = $username;
        $this->email = $email;

        $this->password = $password;
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
