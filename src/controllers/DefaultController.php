<?php

require_once 'AppController.php';
require_once 'src/models/Film.php';

class DefaultController extends AppController {
    public function login() {
       $this->render('login');
    }

    public function dashboard() {
        // @TMP Hardcoded films
        $films = [
            new Film(
                'Saving Private Ryan',
                'public/img/Saving_Private_Ryan.jpg'
            ),
            new Film(
                "Howl's Movinf Castle",
                'public/img/Howls_Moving_Castle.jpg'
            ),
            new Film(
                "Jesteś Bogiem",
                'public/img/Jestes_Bogiem.jpg'
            )
        ];

        $this->render('dashboard', [
                "films" => $films,
                "title" => "Films"
        ]);
    }
}
