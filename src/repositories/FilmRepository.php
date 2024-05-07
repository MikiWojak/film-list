<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Film.php';

class FilmRepository extends Repository
{
    // @TODO Add film rates if user logged in
    public function findAll(): array
    {
        $result = [];

        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT *
            FROM "FilmsDetailDirector"
        ');
        $stmt->execute();
        $this->database->disconnect();

        $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($films as $film) {
            $result[] = new Film(
                $film['title'],
                $film['posterUrl'],
                $film['description'],
                $film['releaseDate'],
                new Director(
                    $film['firstName'],
                    $film['lastName'],
                    $film['directorId'],
                ),
                $film['avgRate'],
                $film['id'],
                $film['filmCreatedAt']
            );
        }

        return $result;
    }

    public function findAllByTitle(string $title): array {
        $title = '%'.strtolower($title).'%';

        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT *
            FROM "FilmsDetailDirector"
            WHERE
                LOWER("title") LIKE :title OR
                LOWER("description") LIKE :title
        ');
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        $this->database->disconnect();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // @TODO Utilize
    public function findById(string $id): ?Film
    {
        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT *
            FROM "FilmsDetailDirector"
            WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $this->database->disconnect();

        $film = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($film === false) {
            return null;
        }

        return new Film(
            $film['title'],
            $film['posterUrl'],
            $film['description'],
            $film['releaseDate'],
            new Director(
                $film['firstName'],
                $film['lastName'],
                $film['directorId'],
            ),
            $film['avgRate'],
            $film['id'],
        );
    }

    public function create(Film $film): void
    {
        $this->database->connect();

        $stmt = $this->database->getConnection()->prepare('
            WITH "FilmRow" AS (
                INSERT INTO "Films" ("title", "posterUrl")
                VALUES (?, ?)
                RETURNING "id"
            )
            INSERT INTO "FilmDetails" ("filmId", "description", "releaseDate", "directorId")
            VALUES ((SELECT id FROM "FilmRow"), ?, ?, ?)
        ');
        $stmt->execute([
            $film->getTitle(),
            $film->getPosterUrl(),
            $film->getDescription(),
            $film->getReleaseDate(),
            $film->getDirector()->getId()
        ]);

        $this->database->disconnect();
    }

    public function rate(string $filmId, int $rate): void
    {
        $loggedUser = unserialize($_SESSION['loggedUser']);
        $loggedUserId = $loggedUser->getId();

        $this->database->connect();

        // Check if rate already exists
        $stmt = $this->database->getConnection()->prepare('
            SELECT *
            FROM "Film2User"
            WHERE
                "filmId" = ? AND
                "userId" = ?
        ');
        $stmt->execute([
            $filmId,
            $loggedUserId
        ]);
        $result = $stmt->fetch();

        if ($result) {
            $updateStmt = $this->database->getConnection()->prepare('
                UPDATE "Film2User" 
                SET "rate" = :rate
                WHERE
                    "filmId" = :filmId AND
                    "userId" = :userId
            ');
            $updateStmt->bindParam(':rate', $rate, PDO::PARAM_INT);
            $updateStmt->bindParam(':filmId', $filmId, PDO::PARAM_STR);
            $updateStmt->bindParam(':userId', $loggedUserId, PDO::PARAM_STR);
            $updateStmt->execute();
        } else {
            $insertStmt = $this->database->getConnection()->prepare('
                INSERT INTO "Film2User" ("filmId", "userId", "rate") 
                VALUES (:filmId, :userId, :rate)
            ');
            $insertStmt->bindParam(':filmId', $filmId, PDO::PARAM_STR);
            $insertStmt->bindParam(':userId', $loggedUserId, PDO::PARAM_STR);
            $insertStmt->bindParam(':rate', $rate, PDO::PARAM_INT);
            $insertStmt->execute();
        }

        $this->database->disconnect();

        // Update avg rate (separate function)
    }

    public function removeRate(string $filmId): void {
        // @TODO
    }

    private function updateAvgRate(string $filmId): void {
        // @TODO
        $this->database->connect();
        $stmt = $this->database->getConnection()->prepare('
            SELECT *
            FROM "Film2User"
            WHERE
                "filmId" = ? AND
                "userId" = ?
        ');

        // @TODO Implement
//        UPDATE "Films"
//        SET "avgRate" = (
//                SELECT AVG(rate)
//            FROM "Film2User"
//            WHERE
//                "filmId" = ?
//        )
//        WHERE "id" = ?
//                ;
    }
}
