<?php

class Role
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    private $name;
    private $id;

    public function __construct(string $name, string $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getId() : ?string {
        return $this->id;
    }
}
