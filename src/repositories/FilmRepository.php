<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Film.php';

class FilmRepository extends Repository
{
    public function findAll(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM "Films"'
        );
        $stmt->execute();

        $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($films as $film) {
            $result[] = new Film(
                $film['title'],
                $film['description'],
                $film['posterUrl'],
            );
        }

        return $result;
    }

    public function findById(int $id): ?Film
    {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM "Films" WHERE id = :$id'
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $film = $stmt->fetch(PDO::FETCH_ASSOC);

        // @TODO Throw Exception
        if ($film === false) {
            return null;
        }

        return new Film(
            $film['title'],
            $film['description'],
            $film['posterUrl']
        );
    }

    public function create(Film $film): void {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO "Films" ("title", "description", "posterUrl", "createdAt")
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $film->getTitle(),
            $film->getDesctription(),
            $film->getPosterUrl(),
            $date->format('Y-m-d H:i:s'),
        ]);
    }
}
