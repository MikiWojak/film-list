<?php

require_once 'AppController.php';
require_once 'src/models/Film.php';

class DefaultController extends AppController {
    public function login() {
       $this->render('login', [
           "messages" => [
               "<div>Hello there</div>",
               "<div>Lorem ipsum</div>"
           ]
       ]);
    }

    public function dashboard() {
        // @TMP Hardcoded films
        $films = [
            new Film(
                "Saving Private Ryan",
                'public/img/Saving_Private_Ryan.jpg'
            ),
            new Film(
                "Howl's Moving Castle",
                'public/img/Howls_Moving_Castle.jpg'
            ),
            new Film(
                'Monthy Python and Holy Grail',
                'public/img/Monthy_Python_Holy_Grail.jpg'
            ),
            new Film(
                "Jesteś Bogiem",
                'public/img/Jestes_Bogiem.jpg'
            ),
            new Film(
                "The Lord of the Rings: The fellowship of the Ring",
                'public/img/LOTR_Part_1.jpg'
            ),
            new Film(
                "Chłopaki nie płaczą",
                'public/img/Chlopaki_Nie_Placza.jpg'
            ),
            new Film(
                "Macross: Do You Remember Love?",
                'public/img/Macross_DYRL.jpg'
            ),
            new Film(
                "Karbala",
                'public/img/Karbala.jpg'
            )
        ];

        $this->render('dashboard', [
            "films" => $films,
            "title" => "Films"
        ]);
    }
}
