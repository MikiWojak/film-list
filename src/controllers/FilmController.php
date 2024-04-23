<?php

require_once 'AppController.php';
require_once 'src/models/Film.php';
require_once __DIR__ .'/../repositories/FilmRepository.php';

class FilmController extends AppController
{
    private $filmRepository;

    public function __construct()
    {
        parent::__construct();

        $this->filmRepository = new FilmRepository();
    }

    public function films() {
        $films = $this->filmRepository->findAll();

        $this->render('films', [
            "films" => $films,
            "title" => "Films"
        ]);
    }
}
