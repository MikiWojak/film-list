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
                $film['posterUrl'],
                $film['avgRate'],
                $film['id']
            );
        }

        return $result;
    }

    public function findAllByTitle(string $title): array {
        $title = '%'.strtolower($title).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM "Films" WHERE LOWER("title") LIKE :title
        ');
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(string $id): ?Film
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
            $film['posterUrl'],
            $film['avgRate'],
            $film['id']
        );
    }

    public function create(Film $film): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO "Films" ("title", "posterUrl")
            VALUES (?, ?)
        ');

        $stmt->execute([
            $film->getTitle(),
            $film->getPosterUrl(),
        ]);
    }
}
