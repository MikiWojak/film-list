<?php

class Film {
    private $title;
    private $desctription;
    private $posterUrl;
    // @TODO avgRate
    // @TODO director
    // @TODO tags
    
    public function __construct(
        string $title,
        string $desctription,
        string $posterUrl,
    ) {
        $this->title = $title;
        $this->desctription = $desctription;
        $this->posterUrl = $posterUrl;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getPosterUrl() : string {
        return $this->posterUrl;
    }
}
