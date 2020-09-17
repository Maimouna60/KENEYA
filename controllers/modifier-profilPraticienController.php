<?php

if(!isset($_SESSION['profile']['id'])){
    header('Location: ../index.php');
    exit;
}

$modifyUsersQuery = new users();
$modifyDoctorQuery = new doctor();

$modifyUsersQuery->id = $modifyDoctorQuery->id_dom20_users = $_SESSION['profile']['id'];

if(!$modifyDoctorQuery->checkUserUnavailabilityByFieldName('id_dom20_users')){
    header('Location: ../index.php');
    exit;
}

$formErrors = array();

$regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
$regexpPwd ='/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
$regexpPrice ='/^[1-9]([0-9]{3,4})$/';
$regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';

$specialities = new specialities();
$placename= new practiceplace();

$specialitiesName = $specialities->getSpecialitiesName();
$practicesPlace = $placename->getPracticesPlaceName();

//verification formulaire pour modif un Doctor
if(isset($_POST['modifyDoctor'])){
    /**
     * Cette variable sert à savoir si les vérifications du mot de passe et de sa confirmation se sont déroulés avec succès
     */
    $isPasswordOk = true;
    //instancier notre requete de la class Doctor
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
           $modifyUsersQuery->mail = htmlspecialchars($_POST['mail']);
        }else {
            $formErrors['mail'] = 'Votre mail n\'est pas valide, veuillez utiliser le format : Dr.Sy@gmail.com';
        }
    }else {
        $formErrors['mail'] = 'Veuillez entrer votre adresse mail.';
    }

    if (!empty($_POST['lastname'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['lastname'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpName)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $modifyUsersQuery->lastname = htmlspecialchars($_POST['lastname']);
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
            $modifyUsersQuery->firstname = htmlspecialchars($_POST['firstname']);
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
            $modifyDoctorQuery->phoneNumbers = htmlspecialchars($_POST['phoneNumbers']);
        //si une valeur existe mais qu'elle est non conforme à la regexp, afficher le message d'erreur suivant : 
        }else {
            $formErrors['phoneNumbers'] = 'Votre numéro de telephone n\'est pas validee.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['phoneNumbers'] = 'Veuillez entrer votre numero de téléphone portable';
    }

    if(!empty($_POST['practicePlace'])){
        //J'hydrate mon instance d'objet user
        $modifyDoctorQuery->id_dom20_practiceplace = htmlspecialchars($_POST['practicePlace']);
    }else{
        $formErrors['practicePlace'] = '';
    }

    if (!empty($_POST['price'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['price'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPrice)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $modifyDoctorQuery->price = htmlspecialchars($_POST['price']);
        //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
        }else {
            $formErrors['price'] = 'Le montant n\'est pas valide.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['price'] = 'Veuillez entrer le prix de vos consultations.';
    }
       
    if(!empty($_POST['specialitiesName'])){
        //J'hydrate mon instance d'objet user
        $modifyDoctorQuery->id_dom20_specialities = htmlspecialchars($_POST['specialitiesName']);
    }else{
        $formErrors['specialitiesName'] = '';
    }
   
    if(empty($formErrors)){
        try {
            $modifyUsersQuery->beginTransaction();
            $modifyDoctorQuery->modifyDoctor();
            $modifyUsersQuery->modifyUsers();
            $modifyUsersQuery->commit();
            $modifyDoctorMessage = 'La modification a bien été prise en compte'; 
        }catch(Exception $e) {
            $modifyUsersQuery->rollBack();
            $modifyDoctorMessage = 'UNE ERREUR EST SURVENUE PANDANT L \'ENREGISTREMENT.VEUILLEZ CONTACTER LE SERVICE INFORMATIQUE.';    
        }
    }  
}

$users = $modifyUsersQuery->getUserDocDetails();
