<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Role.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function findByUsername(string $username, bool $includePassword = false): ?User
    {
        $baseFields = '"id", "username", "email", "createdAt"';
        $fields = $includePassword ? $baseFields.', "password"' : $baseFields;

        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT '.$fields.' FROM "Users" WHERE username = :username
        ');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $this->database->disconnect();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            return null;
        }

        return new User(
            $user['username'],
            $user['email'],
            $user['password'] ?? null,
            $user['id']
        );
    }

    public function findByEmail(string $email, bool $includePassword = false): ?User
    {
        $baseFields = '"id", "username", "email", "createdAt"';
        $fields = $includePassword ? $baseFields.', "password"' : $baseFields;

        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT '.$fields.' FROM "Users" WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $this->database->disconnect();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            return null;
        }

        return new User(
            $user['username'],
            $user['email'],
            $user['password'] ?? null,
            $user['id']
        );
    }

    public function create(User $user, Role $role) : void
    {
        $this->database->connect();

        $stmt = $this->database->getConnection()->prepare('
                WITH "UserRow" AS (
                    INSERT INTO "Users" ("username", "email", "password")
                    VALUES (?, ?, ?)
                    RETURNING id
                )
                INSERT INTO "Role2User" ("roleId", "userId") VALUES (?, (SELECT id FROM "UserRow"))
            ');
        $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $role->getId(),
        ]);

        $this->database->disconnect();
    }
}
