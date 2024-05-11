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
        if (
            $this->isPost() &&
            is_uploaded_file($_FILES['poster']['tmp_name']) &&
            $this->validate($_FILES['poster'])
        ) {
            move_uploaded_file(
                $_FILES['poster']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['poster']['name']
            );

            $film = new Film(
                $_POST['title'],
                $_FILES['poster']['name'],
                $_POST['description'],
                $_POST['releaseDate'],
            );

            $this->filmRepository->create($film);

            $url = "http://$_SERVER[HTTP_HOST]";
            return header("Location: {$url}/adminfilms");
        }

        $this->showCreateEditPage();
    }

    public function adminupdatefilm ()
    {
        if(!$this->isPost()) {
            $id = $_GET['id'];

            return $this->render('admin-films-createedit', [
                'film' => $this->filmRepository->findById($id)
            ]);
        }
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

    private function showCreateEditPage() {
        return $this->render(
            'admin-films-createedit',
            ['messages' => $this->message]
        );
    }
}
