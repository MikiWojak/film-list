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

    public function index() {
        $loggedUserId = isset($_SESSION['loggedUser'])
            ? unserialize($_SESSION['loggedUser'])->getId()
            : null;

        $films = $this->filmRepository->findAll($loggedUserId);

        $this->render('films', [
            "films" => $films,
        ]);
    }

    // @TODO Load assets (CSS, images)
    public function film(string $id = null) {
        if($id === null) {
            $this->render('single-film');
        }

//        $isCss = strpos($_SERVER["REQUEST_URI"], "css");
//
//        if($isCss !== false) {
//            $urlParts = explode("/", $_SERVER["REQUEST_URI"]);
//            $cssFile = $urlParts[4];
//
//            header('Content-type: text/css');
//
//            return $this->renderCss($cssFile);
//        }

        $film = $this->filmRepository->findById($id);

        $this->render('single-film', [
            'film' => $film
        ]);
    }

    public function search() {
        $loggedUserId = isset($_SESSION['loggedUser'])
            ? unserialize($_SESSION['loggedUser'])->getId()
            : null;

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if($contentType !== "application/json") {
            $this->render('films', [
                "films" => $this->filmRepository->findAll($loggedUserId),
            ]);
        }

        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($this->filmRepository->findAllByTitle($decoded["search"], $loggedUserId));
    }

    public function rate(string $id) {
        $loggedUser = unserialize($_SESSION['loggedUser']);
        $loggedUserId = $loggedUser->getId();

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if($contentType !== "application/json") {
            header('Content-type: application/json');
            http_response_code(400);
            echo json_encode([]);

            return;
        }

        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        $rate = intval($decoded["rate"]);

        try {
            $this->filmRepository->rate($id, $loggedUserId, $rate);

            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode([]);
        } catch(Exception $e) {
            header('Content-type: application/json');
            http_response_code(500);
            echo json_encode([]);
        }
    }

    public function removerate(string $id) {
        $loggedUser = unserialize($_SESSION['loggedUser']);
        $loggedUserId = $loggedUser->getId();

        try {
            $this->filmRepository->removeRate($id, $loggedUserId);

            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode([]);
        } catch(Exception $e) {
            header('Content-type: application/json');
            http_response_code(500);
            echo json_encode([]);
        }
    }
}
