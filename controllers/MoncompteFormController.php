<?php
$formErrors = array();

if(isset($_POST['connexion'])){
        //Si le champ est bien rempli

        if (!empty($_POST['mail'])) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $addPatient->mail = htmlspecialchars($_POST['mail']);
            }else {
                $formErrors['mail'] = 'Votre mail n\'est pas valide, veuillez utiliser le format : Mai.kanisd@gmail.com';
            }
        }else {
            $formErrors['mail'] = 'Veuillez entrer votre adresse mail.';
        }

        if(!empty($_POST['password'])){
            if(preg_match($regexList['password'], $_POST['password'])){
                $password = htmlspecialchars($_POST['password']);
            }else{
                $formErrors['password'] = 'Votre mot de passe est incorrect';
            }
        }else{
            $formErrors['password'] = 'Veuillez renseigner votre mot de passe';
        }
    }
