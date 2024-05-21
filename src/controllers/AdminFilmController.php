<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Film.php';
require_once __DIR__ .'/../repositories/FilmRepository.php';

class AdminFilmController extends AppController {
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];
    private $filmRepository;

    public function __construct()
    {
        parent::__construct();

        $this->filmRepository = new FilmRepository();
    }

    public function adminfilms() {
        $films = $this->filmRepository->findAll();

        return $this->render('admin-films', [
            "films" => $films,
            'messages' => $this->message
        ]);
    }

    public function admincreatefilm()
    {
        if(!$this->isPost()) {
            return $this->showCreateEditPage();
        }

        $title = $_POST['title'];
        $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
        $releaseDate = $_POST['releaseDate'];

        if (!$this->validate($title, $description, $releaseDate)) {
            return $this->showCreateEditPage();
        }

        if (!is_uploaded_file($_FILES['poster']['tmp_name'])) {
            $this->message[] = "File is not uploaded.";

            return $this->showCreateEditPage();
        }

        if (!$this->validateFile($_FILES['poster'])) {
            return $this->showCreateEditPage();
        }

        move_uploaded_file(
            $_FILES['poster']['tmp_name'],
            dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['poster']['name']
        );

        $film = new Film(
            $title,
            $_FILES['poster']['name'],
            $description,
            $releaseDate,
        );

        $this->filmRepository->create($film);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/adminfilms");
    }

    public function adminupdatefilm ()
    {
        if (!$this->isPost()) {
            $id = $_GET['id'];

            $film = $this->filmRepository->findById($id);

            if ($film === null) {
                $this->message[] = "Film not found.";
            }

            return $this->showCreateEditPage($film);
        }

        $id = $_POST['filmId'];
        $film = $this->filmRepository->findById($id);

        if ($film === null) {
            $this->message[] = "Film not found.";

            return $this->showCreateEditPage();
        }

        $title = $_POST['title'];
        $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
        $releaseDate = $_POST['releaseDate'];

        if (!$this->validate($title, $description, $releaseDate)) {
            return $this->showCreateEditPage($film);
        }

        $film->setTitle($title);
        $film->setDescription($description);
        $film->setReleaseDate($releaseDate);

        $this->filmRepository->update($film);

        return $this->render('admin-films-createedit', [
            'film' => $this->filmRepository->findById($id),
            'messages' => ["Film has been updated."]
        ]);
    }

    public function admindeletefilm()
    {
        $id = $_GET['id'];

        $this->filmRepository->delete($id);

        $this->render('admin-films', [
            'films' => $this->filmRepository->findAll(),
            'messages' => ["Film has been deleted."]
        ]);
    }

    private function validate(string $title, string $description, string $releaseDate): bool
    {
        if(empty($title) || empty($description) || empty($releaseDate)) {
            $this->message[] = 'Fill in all fields.';

            return false;
        }

        return true;
    }

    private function validateFile(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';

            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';

            return false;
        }

        return true;
    }

    private function showCreateEditPage(Film $film = null) {
        return $this->render(
            'admin-films-createedit', [
                'film' => $film,
                'messages' => $this->message
            ]
        );
    }
}
