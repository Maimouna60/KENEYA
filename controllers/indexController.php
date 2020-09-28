<?php
//Gestion des actions
if(isset($_GET['action'])){
    if($_GET['action'] == 'disconnect'){
        var_dump($_GET);
        //Pour deconnecter l'utilisateur on détruit sa session
        session_destroy();
        //Et on le redirige vers l'accueil
        header('Location:index.php');
        exit();
    }
}
