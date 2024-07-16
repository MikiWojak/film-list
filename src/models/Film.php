<?php

class Film
{
    private $id;
    private $title;
    private $posterUrl;
    private $avgRate;
    private $description;
    private $releaseDate;
    private $createdAt;
    private $rate;

    public function __construct(
        string $title,
        string $posterUrl,
        string $description,
        string $releaseDate,
        float $avgRate = 0,
        string $id = null,
        string $createdAt = null,
        int $rate = null
    )
    {
        $this->title = $title;
        $this->posterUrl = $posterUrl;
        $this->description = $description;
        $this->releaseDate = $releaseDate;

        $this->avgRate = $avgRate;
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->rate = $rate;
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

    public function getAvgRate() : float
    {
        return $this->avgRate;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCreatedAt(): ?string {
        return $this->createdAt;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }
}
