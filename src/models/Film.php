<?php

class Film {
    private $title;
    private $posterUrl;
    // @TODO desctiption;
    // @TODO rateAvg
    // @TODO director
    // @TODO tags
    
    public function __construct(
            string $title,
            string $posterUrl,
    ) {
        $this->title = $title;
        $this->posterUrl = $posterUrl;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getPosterUrl() : string {
        return $this->posterUrl;
    }
}
