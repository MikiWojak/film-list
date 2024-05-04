<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
       $this->render('login');
    }

    public function profile() {
        if (!isset($_SESSION['loggedUser'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            return header("Location: {$url}/login");
        }

        $this->render('profile');
    }
}
