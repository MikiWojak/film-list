<?php

class Film {
    private $id;
    private $title;
    private $desctription;
    private $posterUrl;
    private $avgRate;
    // @TODO director
    // @TODO tags

    public function __construct(
        string $title,
        string $desctription,
        string $posterUrl,
        float $avgRate = 0,
        int $id = null
    ) {
        $this->title = $title;
        $this->desctription = $desctription;
        $this->posterUrl = $posterUrl;

        $this->avgRate = $avgRate;
        $this->id = $id;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getDesctription(): string
    {
        return $this->desctription;
    }

    public function getPosterUrl() : string {
        return $this->posterUrl;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvgRate() : float
    {
        return $this->avgRate;
    }
}
