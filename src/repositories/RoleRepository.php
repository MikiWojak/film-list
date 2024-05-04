<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Role.php';

class RoleRepository extends Repository
{
    public function findByName(string $name): ?Role
    {
        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT * FROM "Roles" WHERE name = :name
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $this->database->disconnect();

        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($role === false) {
            return null;
        }

        return new Role(
            $role['name'],
            $role['id']
        );
    }
}
