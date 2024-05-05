<?php

require_once 'AppController.php';
require_once  __DIR__.'/../repositories/DirectorRepository.php';

class AdminDirectorController extends AppController {
    private $directorRepository;

    public function __construct()
    {
        parent::__construct();

        $this->directorRepository = new DirectorRepository();
    }

    public function admindirectors() {
        $directors = $this->directorRepository->findAll();

        return $this->render('admin-directors', [
            'directors' => $directors
        ]);
    }
}
