<?php
//Choix de la vue à afficher et configuration du titre
if(isset($_GET['view'])){
    if($_GET['view'] == 'registerPatient'){
        $view = 'register';
        $title = REGISTER_TITLE;
    }else if($_GET['view'] == 'loginOnly'){
        $view = 'loginOnly';
        $title = LOGIN_TITLE;
    }
}
//Gestion des actions
if(isset($_GET['action'])){
    if($_GET['action'] == 'disconnect'){
        //Pour deconnecter l'utilisateur on détruit sa session
        session_destroy();
        //Et on le redirige vers l'accueil
        header('location:header.php');
        exit();
    }
}

    
if(isset($_GET['view'])){
    if($_GET['view'] == 'registerPraticien'){
        $view = 'register';
        $title = REGISTER_TITLE;
    }else if($_GET['view'] == 'loginOnly'){
        $view = 'loginOnly';
        $title = LOGIN_TITLE;
    }
}

