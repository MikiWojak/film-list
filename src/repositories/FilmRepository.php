<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Film.php';

class FilmRepository extends Repository
{
    public function findAll(string $loggedUserId = null): array
    {
        $this->database->connect();

        $stmt = null;

        if ($loggedUserId === null) {
            $stmt = $this->database->getConnection()->prepare('
                SELECT *
                FROM "FilmsDetail"
            ');
        } else {
            $stmt = $this->database->getConnection()->prepare('
                SELECT "fd".*, "f2u"."rate"
                FROM "FilmsDetail" fd
                LEFT JOIN "Film2User" f2u ON 
                    "fd".id = "f2u"."filmId" AND 
                    "f2u"."userId" = :userId
            ');
            $stmt->bindValue(':userId', $loggedUserId, PDO::PARAM_STR);
        }

        $stmt->execute();

        $this->database->disconnect();

        $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($films as $film) {
            $result[] = new Film(
                $film['title'],
                $film['posterUrl'],
                $film['description'],
                $film['releaseDate'],
                $film['avgRate'],
                $film['id'],
                $film['filmCreatedAt'],
                $film['rate'] ?? null
            );
        }

        return $result;
    }

    public function findAllByTitle(string $title, string $loggedUserId = null): array {
        $title = '%'.strtolower($title).'%';

        $this->database->connect();

        $stmt = null;

        if ($loggedUserId === null) {
            $stmt = $this->database->getConnection()->prepare('
                SELECT *
                FROM "FilmsDetail"
                WHERE
                    LOWER("title") LIKE :title OR
                    LOWER("description") LIKE :title
            ');
        } else {
            $stmt = $this->database->getConnection()->prepare('
                SELECT "fd".*, "f2u"."rate"
                FROM "FilmsDetail" fd
                LEFT JOIN "Film2User" f2u ON 
                    "fd".id = "f2u"."filmId" AND 
                    "f2u"."userId" = :userId
                WHERE
                    LOWER("title") LIKE :title OR
                    LOWER("description") LIKE :title
            ');
            $stmt->bindValue(':userId', $loggedUserId, PDO::PARAM_STR);
        }

        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->execute();

        $this->database->disconnect();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(string $id, string $loggedUserId = null): ?Film
    {
        $this->database->connect();

        $stmt = null;

        if ($loggedUserId === null) {
            $stmt = $this->database->getConnection()->prepare('
                SELECT *
                FROM "FilmsDetail"
                WHERE "id" = :id
            ');
        } else {
            $stmt = $this->database->getConnection()->prepare('
                SELECT "fd".*, "f2u"."rate"
                FROM "FilmsDetail" fd
                LEFT JOIN "Film2User" f2u ON 
                    "fd".id = "f2u"."filmId" AND 
                    "f2u"."userId" = :userId
                WHERE "id" = :id
            ');
            $stmt->bindValue(':userId', $loggedUserId, PDO::PARAM_STR);
        }

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
            $film['avgRate'],
            $film['id'],
            $film['filmCreatedAt'],
            $film['rate'] ?? null
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
            INSERT INTO "FilmDetails" ("filmId", "description", "releaseDate")
            VALUES ((SELECT id FROM "FilmRow"), ?, ?)
        ');
        $stmt->execute([
            $film->getTitle(),
            $film->getPosterUrl(),
            $film->getDescription(),
            $film->getReleaseDate(),
        ]);

        $this->database->disconnect();
    }

    public function update(Film $film): void {
        $this->database->connect();

        $stmt = $this->database->getConnection()->prepare('
            WITH "UpdatedFilm" AS (
                UPDATE "Films"
                SET "title" = ?
                WHERE "id" = ?
                RETURNING "id"
            )
            UPDATE "FilmDetails"
            SET "description" = ?,
                "releaseDate" = ?
            WHERE "filmId" = (SELECT "id" FROM "UpdatedFilm")
        ');
        $stmt->execute([
            $film->getTitle(),
            $film->getId(),
            $film->getDescription(),
            $film->getReleaseDate(),
        ]);

        $this->database->disconnect();
    }

    public function delete(string $id): void {
        $this->database->connect();

        $stmt = $this->database->getConnection()->prepare('
            DELETE FROM "Films" WHERE "id" = ?
        ');

        $stmt->execute([
            $id
        ]);

        $this->database->disconnect();
    }

    public function rate(string $filmId, string $userId, int $rate): void
    {
        try {
            $this->database->connect();

            $this->database->getConnection()->beginTransaction();

            $stmt = $this->database->getConnection()->prepare('
                SELECT *
                FROM "Film2User"
                WHERE
                    "filmId" = ? AND
                    "userId" = ?
            ');
            $stmt->execute([
                $filmId,
                $userId
            ]);
            $result = $stmt->fetch();

            if ($result) {
                $stmt = $this->database->getConnection()->prepare('
                    UPDATE "Film2User" 
                    SET "rate" = :rate
                    WHERE
                        "filmId" = :filmId AND
                        "userId" = :userId
                ');
            } else {
                $stmt = $this->database->getConnection()->prepare('
                    INSERT INTO "Film2User" ("filmId", "userId", "rate") 
                    VALUES (:filmId, :userId, :rate)
                ');
            }

            $stmt->bindParam(':filmId', $filmId, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
            $stmt->bindParam(':rate', $rate, PDO::PARAM_INT);
            $stmt->execute();

            $this->updateAvgRate($filmId);

            $this->database->getConnection()->commit();
        } catch (Exception $e) {
            $this->database->getConnection()->rollBack();

            throw $e;
        } finally {
            $this->database->disconnect();
        }
    }

    public function removeRate(string $filmId, $userId): void {
        try {
            $this->database->connect();

            $this->database->getConnection()->beginTransaction();

            $stmt = $this->database->getConnection()->prepare('
                DELETE FROM "Film2User"
                WHERE
                    "filmId" = ? AND
                    "userId" = ?
            ');
            $stmt->execute([
                $filmId,
                $userId
            ]);

            $this->updateAvgRate($filmId);

            $this->database->getConnection()->commit();
        } catch (Exception $e) {
            $this->database->getConnection()->rollBack();

            throw $e;
        } finally {
            $this->database->disconnect();
        }
    }

    public function refreshAllAvgRate(): void {
        $this->database->connect();

        $stmt = $this->database->getConnection()->prepare('
            UPDATE "Films" f
            SET "avgRate" = (
                SELECT COALESCE(AVG("rate"), 0)
                FROM "Film2User" f2u
                WHERE "f2u"."filmId" = "f"."id"
            )
        ');
        $stmt->execute();

        $this->database->disconnect();
    }

    private function updateAvgRate(string $filmId): void {
        $stmt = $this->database->getConnection()->prepare('
            UPDATE "Films"
            SET "avgRate" = (
                SELECT COALESCE(AVG("rate"), 0)
                FROM "Film2User"
                WHERE
                    "filmId" = :filmId
            )
            WHERE "id" = :filmId
        ');
        $stmt->bindParam(':filmId', $filmId, PDO::PARAM_STR);
        $stmt->execute();
    }
}
