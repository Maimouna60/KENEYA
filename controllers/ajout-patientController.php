<?php
$user = new user();
$patient = new patient();
$formErrors = array();
$regexpPwd = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
//verification formulaire pour ajouter un patient
if(isset($_POST['addPatient'])){
    //instancier notre requete de la class patients
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['mail']);
        }else {
            $formErrors['mail'] = 'Votre mail n\'est pas valide, veuillez utiliser le format : Karine.Sy@gmail.com';
        }
    }else {
        $formErrors['mail'] = 'Veuillez entrer votre adresse mail.';
    }
    if (!empty($_POST['lastname'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['lastname'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpName)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $user->lastname = htmlspecialchars($_POST['lastname']);
        //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
        }else {
            $formErrors['lastname'] = 'Votre Nom n\'est pas valide.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['lastname'] = 'Veuillez entrer votre Nom.';
    }
    if (!empty($_POST['firstname'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['firstname'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpName)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $user->firstname = htmlspecialchars($_POST['firstname']);
        //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
        }else {
            $formErrors['firstname'] = 'Votre Prénom n\'est pas valide.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['firstname'] = 'Veuillez entrer votre Prénom.';
    }
    if (!empty($_POST['phoneNumbers'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['phoneNumbers'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPhone)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $patient->phoneNumber = htmlspecialchars($_POST['phoneNumbers']);
        //si une valeur existe mais qu'elle est non conforme à la regexp, afficher le message d'erreur suivant : 
        }else {
            $formErrors['phoneNumbers'] = 'Votre numéro de telephone n\'est pas validee..';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['phoneNumbers'] = 'Veuillez entrer votre numero de téléphone portable';
    }
    if (!empty($_POST['birthdate'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['birthdate'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpDate)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $patient->birthDate = htmlspecialchars($_POST['birthdate']);
        //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
        }else {
            $formErrors['birthdate'] = 'Votre date de naissance n\'est pas valide.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['birthdate'] = 'Veuillez entrer votre date de naissance.';
     
    }
    if(!empty($_POST['password'])){
        if (filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPwd)))) {
            $user->password = password_hash(htmlspecialchars($_POST['password']),PASSWORD_DEFAULT);
        }else{
            $formErrors['password'] = 'Utilisez 8 caractères, minimum 1 lettre et 1 chiffre.';
        }
    }else{
        $formErrors['password'] = 'Veuillez renseigner un mot de passe.'; 
    }
    if(!isset($_POST['validate'])){
        $formErrors['validate'] = 'Pour finaliser votre inscription, veuillez accepter les CGU';
    }

    if (empty($formErrors)) {
        if (!$user->checkUserExist()){
            $arrayErrors= array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            try {
                $user->role = 3;
                $user->db->beginTransaction();
                $user->addUser();
                $userId = $user->db->lastInsertId();
                
                $patient->id_dom20_users = $userId;
                var_dump($patient);
                $patient->addPatient();
                $user->db->commit();
            } 
            catch (\Exception $e) {
                if ($user->db->inTransaction()) {
                    $user->db->rollback();
                }
                throw $e;
            }
        } else {
            $addPatientMessage = 'Le patient a déjà été ajouté.';
        }
    }
}