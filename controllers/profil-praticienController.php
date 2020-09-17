<?php

if(!isset($_SESSION['profile']['id'])){
    header('Location: ../views/index.php');
    exit();
} else {
    if(!isset($_SESSION['profile']['doctorId'])){
        header('Location: ../views/profil-patient.php');
        exit();
    }
}

    //si verification du  profil connecter 
    $usersDocDetails = new users();
    $usersDocDetails->id = $_SESSION['profile']['id']; 
     //je recupere toutes les infos de ma table users
    $users = $usersDocDetails->getUserDocDetails();

    if(isset($_POST['deleteProfilDoctor'])){
        $usersDocDetails->deleteUserById();  
        header('Location: ../index.php');
        exit();
    }else {
        $addUserMessageFail = 'Une erreur est survenue. Veuillez contacter le service technique.';
    }
