<?php

if(!isset($_SESSION['profile']['id'])){
    header('Location: ../views/index.php');
    exit();
} else {
    if(!isset($_SESSION['profile']['patientId'])){
        header('Location: ../views/profil-praticien.php');
        exit();
    }
}
    //si verification du  profil connecter 
    $usersDetails = new users();
    $usersDetails->id = $_SESSION['profile']['id']; 
     //je recupere toutes les infos de ma table users
    $users = $usersDetails->getUserDetails();

    if(isset($_POST['deleteProfilPatient'])){
        $usersDetails->deleteUserById();  
        unset($_SESSION);
        session_destroy();
        header('Location: ../index.php');
        exit();
    }else {
        $addUserMessageFail = 'Une erreur est survenue. Veuillez contacter le service technique.';
    }


    