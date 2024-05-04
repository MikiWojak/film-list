<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        session_start();

       $this->render('login');
    }

    public function profile() {
        session_start();

        if (!isset($_SESSION['loggedUser'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            return header("Location: {$url}/login");
        }

        $this->render('profile');
    }
}
