<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Role.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function findAll(): array {

        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT *
            FROM "UsersRole"
            ORDER BY "createdAt" DESC
        ');
        $stmt->execute();
        $this->database->disconnect();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($users as $user) {
            $result[] = new User(
                $user['username'],
                $user['email'],
                new Role(
                    $user['roleName'],
                    $user['roleId'],
                ),
                null,
                $user['id'],
                $user['createdAt'],
            );
        }

        return $result;
    }

    public function findByUsername(string $username, bool $includePassword = false): ?User
    {
        $limitedFields = '"id", "username", "email", "roleId", "roleName"';
        $fields = $includePassword ? '*' : $limitedFields;

        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT '.$fields.'
            FROM "UsersRole"
            WHERE username = :username
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
            new Role(
                $user['roleName'],
                $user['roleId'],
            ),
            $user['password'] ?? null,
            $user['id'],
        );
    }

    public function findByEmail(string $email, bool $includePassword = false): ?User
    {
        $limitedFields = '"id", "username", "email", "roleId", "roleName"';
        $fields = $includePassword ? '*' : $limitedFields;

        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT '.$fields.'
            FROM "UsersRole"
            WHERE email = :email
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
            new Role(
                $user['roleName'],
                $user['roleId'],
            ),
            $user['password'] ?? null,
            $user['id'],
        );
    }

    public function create(User $user) : void
    {
        $this->database->connect();

        $stmt = $this->database->getConnection()->prepare('
            INSERT INTO "Users" ("username", "email", "password", "roleId")
            VALUES (?, ?, ?, ?)
        ');
        $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRole()->getId(),
        ]);

        $this->database->disconnect();
    }

    public function delete(string $id): void {
        $this->database->connect();

        $stmt = $this->database->getConnection()->prepare('
            DELETE FROM "Users" WHERE "id" = ?
        ');

        $stmt->execute([
            $id
        ]);

        $this->database->disconnect();
    }
}
