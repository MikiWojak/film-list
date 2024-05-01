<?php

class Film {
    private $id;
    private $title;
    private $posterUrl;
    private $avgRate;
    // @TODO description
    // @TODO director
    // @TODO tags

    public function __construct(
        string $title,
        string $posterUrl,
        float $avgRate = 0,
        string $id = null
    ) {
        $this->title = $title;
        $this->posterUrl = $posterUrl;

        $this->avgRate = $avgRate;
        $this->id = $id;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getPosterUrl() : string {
        return $this->posterUrl;
    }

    public function getAvgRate() : float
    {
        return $this->avgRate;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
