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
        session_start();

        $films = $this->filmRepository->findAll();

        $this->render('films', [
            "films" => $films,
        ]);
    }

    // @TODO Implement
    public function film() {
        session_start();

        $this->render('single-film');
    }

    public function search() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if($contentType !== "application/json") {
            // @TODO Show error message
            $this->render('films', [
                "films" => $this->filmRepository->findAll(),
            ]);
        }

        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($this->filmRepository->findAllByTitle($decoded["search"]));
    }
}
