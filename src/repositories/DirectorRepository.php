<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Director.php';

class DirectorRepository extends Repository
{
    public function findAll(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM "Directors"
        ');
        $stmt->execute();
        $this->database->disconnect();

        $directors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($directors as $director) {
            $result[] = new Director(
                $director['firstName'],
                $director['lastName'],
                $director['id'],
            );
        }

        return $result;
    }

    public function findById(string $id): ?Director
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM "Directors" WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $this->database->disconnect();

        $director = $stmt->fetch(PDO::FETCH_ASSOC);

        // @TODO Throw Exception
        if ($director === false) {
            return null;
        }

        return new Director(
            $director['firstName'],
            $director['lastName'],
            $director['id'],
        );
    }

    public function create(Director $director): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO "Directors" ("firstName", "lastName")
            VALUES (?, ?)
        ');

        $stmt->execute([
            $director->getFirstName(),
            $director->getLastName(),
        ]);

        $this->database->disconnect();
    }
}
