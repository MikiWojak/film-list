<?php

class Film {
    private $title;
    private $posterUrl;
    // private $desctiption;
    // @TODO RateAvg
    // @TODO Director
    // @TODO Tags
    
    public function __construct(
            string $title,
            string $posterUrl,
    ) {
        $this->title = $title;
        $this->posterUrl = $posterUrl;
        // $this->desctiption = $desctiption;
    }

    // @TODO Add more getters
    // public function getTitle() : string {
    //     return $this->title;
    // }

    public function getTitle() {
        return $this->title;
    }

    public function getPosterUrl() {
        return $this->posterUrl;
    }
}
