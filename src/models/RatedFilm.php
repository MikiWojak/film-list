<?php

require_once 'Film.php';

class RatedFilm
{
    private $film;
    private $rate;

    public function __construct(Film $film, int $rate = null) {
        $this->film = $film;
        $this->rate = $rate;
    }

    public function getFilm(): Film
    {
        return $this->film;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }
}
