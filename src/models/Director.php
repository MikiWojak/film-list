<?php

class Director {
    private $firstName;
    private $lastName;
    private $id;

    public function __construct($firstName, $lastName, $id = null) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;

        $this->id = $id;
    }

    public function getFirstName() : string {
        return $this->firstName;
    }

    public function getLastName() : string {
        return $this->lastName;
    }

    public function getId() : ?string {
        return $this->id;
    }
}