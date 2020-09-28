<?php

if(!isset($_SESSION['profile']['id'])){
    header('Location: ../views/index.php');
    exit();
} else {
    if(!isset($_SESSION['profile']['doctorId'])){
        header('Location: ../views/profil-praticien.php');
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
        unset($_SESSION);
        session_destroy();
        header('Location: ../index.php');
        exit();
    }else {
        $addUserMessageFail = 'Une erreur est survenue. Veuillez contacter le service technique.';
    }

    //if (!isset($_SESSION['profile']['id'])) {
        //     header('Location: ../views/index.php');
        //     exit();
        // } else {
        //     if (isset($_SESSION['profile']['doctorId']) || $_SESSION['profile']['role'] == 2) {
        
        //         $doctor = new doctor();
        //         if (isset($_GET['doctorId'])) {
        //             $doctor->id = htmlspecialchars($_GET['doctorId']);
        //         }else{
        //             $doctor->id = $_SESSION['profile']['doctorId'];
        //         }
        //         if ($doctor->checkIdDoctorExist()) {
        //             $details = $doctor->getDocDetailsById();
        //         }
        
        //         if (isset($_POST['deleteProfilDoctor'])) {
        //             $usersDocDetails = new users();
        //             $usersDocDetails->id = $details->id_dom20_users;
        //             $usersDocDetails->deleteUserById();
        //             session_destroy();
        //             header('Location: ../index.php');
        //             exit();
        //         } else {
        //             $addUserMessageFail = 'Une erreur est survenue. Veuillez contacter le service technique.';
        //         }
        //     } else {
        //         header('Location: ../views/profil-patient.php');
        //         exit();
        //     }
        // }
