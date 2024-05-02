<?php

require_once 'Director.php';

class Film {
    private $id;
    private $title;
    private $posterUrl;
    private $avgRate;
    private $description;
    private $releaseDate;
    private $director;

    public function __construct(
        string $title,
        string $posterUrl,
        string $description,
        string $releaseDate,
        Director $director,
        float $avgRate = 0,
        string $id = null
    ) {
        $this->title = $title;
        $this->posterUrl = $posterUrl;
        $this->description = $description;
        $this->releaseDate = $releaseDate;
        $this->director = $director;

        $this->avgRate = $avgRate;
        $this->id = $id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getPosterUrl() : string
    {
        return $this->posterUrl;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getDirector(): Director
    {
        return $this->director;
    }

    public function getAvgRate() : float
    {
        return $this->avgRate;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
