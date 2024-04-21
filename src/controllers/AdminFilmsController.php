<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Film.php';

class AdminFilmsController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];

    public function films() {
        return $this->render('admin-films', ['messages' => $this->message]);
    }

    public function addFilm()
    {
        if (
            $this->isPost() &&
            is_uploaded_file($_FILES['file']['tmp_name']) &&
            $this->validate($_FILES['file'])
        ) {
            // @TODO Fix problem with moving uploaded file
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            // TODO create new film object and save it in database
            $film = new Film($_POST['title'], $_POST['description'], $_FILES['file']['name']);

            // @TODO Redirect to Admin Films
//            return $this->render('admin-films', ['messages' => $this->message]);

            $this->render('dashboard', [
                "films" => [$film],
                "title" => "Films"
            ]);
        }

        return $this->render('admin-films-createedit', ['messages' => $this->message]);
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
}