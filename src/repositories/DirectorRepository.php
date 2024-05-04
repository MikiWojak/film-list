<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Director.php';

class DirectorRepository extends Repository
{
    public function findAll(): array
    {
        $result = [];

        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
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
        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT * FROM "Directors" WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $this->database->disconnect();

        $director = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($director === false) {
            return null;
        }

        return new Director(
            $director['firstName'],
            $director['lastName'],
            $director['id'],
        );
    }
}
