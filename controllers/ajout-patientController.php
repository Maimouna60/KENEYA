<?php
// if(isset($_SESSION['profile'])) {
//     if($_SESSION['profile']))
//     header('location: profil-patient.php');
//     exit; 
//     } else {
     
//     if( $_SESSION['profile']['patientId'] = $user->getLastInsertId())){
//         header('Location: ../profil-patient.php');
//         exit;
//     }
    

$user = new users();
$patient = new patients();

$formErrors = array();
$regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
$regexpPwd = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
$regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';
$regexpDate = '/^((19([0-9]{2}))|(20([0-1]{1}[0-9]{1}))){1}(\-)((0([1-9]{1}))|(1([0-2]{1})))(\-)((0([1-9]){1})|([1-2]{1}[0-9]{1})|(3([0-1]{1})))$/';

//verification formulaire pour ajouter un patient
if (isset($_POST['addPatient'])) {
    //instancier notre requete de la class patients
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['mail']);
        } else {
            $formErrors['mail'] = 'Votre mail n\'est pas valide, veuillez utiliser le format : Karine.Sy@gmail.com';
        }
    } else {
        $formErrors['mail'] = 'Veuillez entrer votre adresse mail.';
    }
    if (!empty($_POST['lastname'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['lastname'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpName)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $user->lastname = htmlspecialchars($_POST['lastname']);
            //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
        } else {
            $formErrors['lastname'] = 'Votre Nom n\'est pas valide.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    } else {
        $formErrors['lastname'] = 'Veuillez entrer votre Nom.';
    }
    if (!empty($_POST['firstname'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['firstname'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpName)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $user->firstname = htmlspecialchars($_POST['firstname']);
            //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
        } else {
            $formErrors['firstname'] = 'Votre Prénom n\'est pas valide.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    } else {
        $formErrors['firstname'] = 'Veuillez entrer votre Prénom.';
    }
    if (!empty($_POST['phoneNumbers'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['phoneNumbers'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPhone)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $patient->phoneNumbers = htmlspecialchars($_POST['phoneNumbers']);
            //si une valeur existe mais qu'elle est non conforme à la regexp, afficher le message d'erreur suivant : 
        } else {
            $formErrors['phoneNumbers'] = 'Votre numéro de telephone n\'est pas validee.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    } else {
        $formErrors['phoneNumbers'] = 'Veuillez entrer votre numero de téléphone portable';
    }
    if (!empty($_POST['birthdate'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['birthdate'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpDate)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $patient->birthDate = htmlspecialchars($_POST['birthdate']);
            //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
        } else {
            $formErrors['birthdate'] = 'Votre date de naissance n\'est pas valide.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    } else {
        $formErrors['birthdate'] = 'Veuillez entrer votre date de naissance.';
    }
    if (!empty($_POST['password'])) { 
        if (filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPwd)))) {
            $user->password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
        } else {
            $formErrors['password'] = 'Utilisez 8 caractères, minimum 1 lettre et 1 chiffre.';
        }
    } else {
        $formErrors['password'] = 'Veuillez renseigner un mot de passe.';
    }
    if (!isset($_POST['validate'])) {
        $formErrors['validate'] = 'Pour finaliser votre inscription, veuillez accepter les CGU';
    }
   
    if (empty($formErrors)) {
var_dump($user->checkMailUserExist());
        if (!$user->checkMailUserExist()) {
            try {
                $user->role = 3;
                $user->beginTransaction();
                $user->addUser();
                $patient->id_dom20_users = $user->getLastInsertId();                
                $patient->addPatient();
                $_SESSION['profile']['id'] = $patient->id_dom20_users;
                $_SESSION['profile']['mail'] = $user->mail;
                $_SESSION['profile']['patientId'] = $user->getLastInsertId();
                $user->commit();
            } catch (Exception $e) {
                $user->rollBack();
            }
            $addPatientMessage = 'Le patient a bien été enregistré';
            header('location: profil-patient.php?id=' . $patient->id_dom20_users);
            exit;
        } else {
            $addPatientMessage = 'Le patient existe deja';
        }
    }

}


