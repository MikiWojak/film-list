<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Film.php';
require_once __DIR__ .'/../repositories/FilmRepository.php';
require_once __DIR__ .'/../repositories/DirectorRepository.php';

class AdminFilmController extends AppController {
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];
    private $filmRepository;
    private $directorRepository;

    public function __construct()
    {
        parent::__construct();

        $this->filmRepository = new FilmRepository();
        $this->directorRepository = new DirectorRepository();
    }

    public function adminFilms() {

        return $this->render('admin-films', ['messages' => $this->message]);
    }

    public function adminAddFilm()
    {
        if (
            $this->isPost() &&
            is_uploaded_file($_FILES['poster']['tmp_name']) &&
            $this->validate($_FILES['poster'])
        ) {
            $director = $this->directorRepository->findById($_POST['directorId']);

            if (!$director) {
                $this->message = ['Director not found!'];

                $this->showAddEditPage();
            }

            move_uploaded_file(
                $_FILES['poster']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['poster']['name']
            );

            $film = new Film(
                $_POST['title'],
                $_FILES['poster']['name'],
                $_POST['description'],
                $_POST['releaseDate'],
                $director
            );

            $this->filmRepository->create($film);

            // @TODO Redirect to Admin Films
//            return $this->render('admin-films', ['messages' => $this->message]);

            return $this->render('films', [
                "films" => $this->filmRepository->findAll(),
                "title" => "Films"
            ]);
        }

        $this->showAddEditPage();
    }

    private function validate(array $file): bool
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

    private function showAddEditPage() {
        $directors = $this->directorRepository->findAll();

        return $this->render(
            'admin-films-createedit',
            ['messages' => $this->message, 'directors' => $directors]
        );
    }
}
