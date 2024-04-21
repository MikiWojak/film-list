<?php

require_once 'AppController.php';
require_once 'src/models/Film.php';

class DefaultController extends AppController {
    public function index() {
       $this->render('login');
    }

    public function dashboard() {
        // @TMP Hardcoded films
        $films = [
            new Film(
                "Saving Private Ryan",
                "Lorem ipsum",
                '../../public/img/Saving_Private_Ryan.jpg'
            ),
            new Film(
                "Howl's Moving Castle",
                "Lorem ipsum",
                '../../public/img/Howls_Moving_Castle.jpg'
            ),
            new Film(
                'Monthy Python and Holy Grail',
                "Lorem ipsum",
                '../../public/img/Monthy_Python_Holy_Grail.jpg'
            ),
            new Film(
                "Jesteś Bogiem",
                "Lorem ipsum",
                '../../public/img/Jestes_Bogiem.jpg'
            ),
            new Film(
                "The Lord of the Rings: The fellowship of the Ring",
                "Lorem ipsum",
                '../../public/img/LOTR_Part_1.jpg'
            ),
            new Film(
                "Chłopaki nie płaczą",
                "Lorem ipsum",
                '../../public/img/Chlopaki_Nie_Placza.jpg'
            ),
            new Film(
                "Macross: Do You Remember Love?",
                "Lorem ipsum",
                '../../public/img/Macross_DYRL.jpg'
            ),
            new Film(
                "Karbala",
                "Lorem ipsum",
                '../../public/img/Karbala.jpg'
            )
        ];

        $this->render('dashboard', [
            "films" => $films,
            "title" => "Films"
        ]);
    }
}
