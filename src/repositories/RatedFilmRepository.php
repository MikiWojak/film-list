<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Film.php';
require_once __DIR__.'/../models/RatedFilm.php';

class RatedFilmRepository extends Repository
{
    public function findAll(string $loggedUserId = null): array
    {
        $this->database->connect();

        $stmt = null;

        if ($loggedUserId === null) {
            $stmt = $this->database->getConnection()->prepare('
                SELECT *
                FROM "FilmsWithDetails"
            ');
        } else {
            $stmt = $this->database->getConnection()->prepare('
                SELECT "fd".*, "f2u"."rate"
                FROM "FilmsWithDetails" fd
                LEFT JOIN "Film2User" f2u ON 
                    "fd".id = "f2u"."filmId" AND 
                    "f2u"."userId" = :userId
            ');
            $stmt->bindValue(':userId', $loggedUserId, PDO::PARAM_STR);
        }

        $stmt->execute();

        $this->database->disconnect();

        $ratedFilms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($ratedFilms as $ratedFilm) {
            $result[] = new RatedFilm(
                new Film(
                    $ratedFilm['title'],
                    $ratedFilm['posterUrl'],
                    $ratedFilm['description'],
                    $ratedFilm['releaseDate'],
                    $ratedFilm['avgRate'],
                    $ratedFilm['id'],
                    $ratedFilm['filmCreatedAt']
                ),
                $ratedFilm['rate'] ?? null
            );
        }

        return $result;
    }

    public function findAllByTitleAndRated(string $title, bool $rated, string $loggedUserId = null): array {
        $title = '%'.strtolower($title).'%';

        $this->database->connect();

        $stmt = null;

        if ($loggedUserId === null) {
            $stmt = $this->database->getConnection()->prepare('
                SELECT *
                FROM "FilmsWithDetails"
                WHERE
                    LOWER("title") LIKE :title OR
                    LOWER("description") LIKE :title
            ');
        } else {
            $stmt = $this->database->getConnection()->prepare('
                SELECT "fd".*, "f2u".*
                FROM "FilmsWithDetails" fd
                LEFT JOIN "Film2User" f2u ON 
                    "fd".id = "f2u"."filmId" AND 
                    "f2u"."userId" = :userId
                WHERE (
                    LOWER("title") LIKE :title OR
                    LOWER("description") LIKE :title
                )'
                . ($loggedUserId && $rated ? ' AND "f2u"."userId" IS NOT NULL' : '')
            );
            $stmt->bindValue(':userId', $loggedUserId, PDO::PARAM_STR);
        }

        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->execute();

        $this->database->disconnect();

        $ratedFilms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [];

        foreach ($ratedFilms as $ratedFilm) {
            $data[] = [
                'film' => [
                    'id' => $ratedFilm['id'],
                    'title' => $ratedFilm['title'],
                    'posterUrl' => $ratedFilm['posterUrl'],
                    'description' => $ratedFilm['description'],
                    'releaseDate' => $ratedFilm['releaseDate'],
                    'avgRate' => $ratedFilm['avgRate'],
                    'createdAt' => $ratedFilm['filmCreatedAt'],
                ],
                'rate' => $ratedFilm['rate'] ?? null,
            ];
        }

        return $data;
    }

    public function findById(string $id, string $loggedUserId = null): ?RatedFilm
    {
        $this->database->connect();

        $stmt = null;

        if ($loggedUserId === null) {
            $stmt = $this->database->getConnection()->prepare('
                SELECT *
                FROM "FilmsWithDetails"
                WHERE "id" = :id
            ');
        } else {
            $stmt = $this->database->getConnection()->prepare('
                SELECT "fd".*, "f2u"."rate"
                FROM "FilmsWithDetails" fd
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

        $ratedFilm = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ratedFilm === false) {
            return null;
        }

        return new RatedFilm(
            new Film(
                $ratedFilm['title'],
                $ratedFilm['posterUrl'],
                $ratedFilm['description'],
                $ratedFilm['releaseDate'],
                $ratedFilm['avgRate'],
                $ratedFilm['id'],
                $ratedFilm['filmCreatedAt']
            ),
            $ratedFilm['rate'] ?? null
        );
    }
}
