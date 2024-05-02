<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function findByEmail(string $email): ?User
    {
        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT * FROM "Users" WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $this->database->disconnect();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // @TODO Throw Exception
        if ($user === false) {
            return null;
        }

        return new User(
            $user['username'],
            $user['email'],
            $user['password']
        );
    }

    public function create(User $user) : void
    {
        // @TODO Add role

        $this->database->connect();

        $stmt = $this->database->getConnection()->prepare('
                INSERT INTO "Users" ("username", "email", "password")
                VALUES (?, ?, ?)
            ');
        $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
        ]);

        $this->database->disconnect();
    }
}
