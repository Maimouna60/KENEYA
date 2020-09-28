<?php

$user = new users();
$formErrors = array();
$regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
$regexpPwd ='/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
$regexpPrice ='/^[1-9]([0-9]{3,4})$/';
$regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';
$regexpDate = '/^(19((0[4|8])|([1|3|5|7|9][2|6])|([2|4|6|8][0|4|8]))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((20((0[0|4|8])|(1[2|6])|20))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((19[0-9][0-9])|(20([0-1][0-9])|20))[ \-\/]((((0[4|6|9])|11)[ \-\/]((0[1-9])|([1|2][0-9])|30))|(((0[1|3|5|7|8])|1([0|2]))[ \-\/]((0[1-9])|([1|2][0-9])|3([0-1]))))$/';
$specialities = new specialities();
$specialitiesName = $specialities->getSpecialitiesName();
$placename = new practiceplace();
$practicesPlace = $placename->getPracticesPlaceName();
//verification formulaire pour ajouter un Doctor
if(isset($_POST['addDoctor'])){
    $doctor = new doctor();
    /**
     * Cette variable sert à savoir si les vérifications du mot de passe et de sa confirmation se sont déroulés avec succès
     */
    $isPasswordOk = true;
    //instancier notre requete de la class Doctor  ou user
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['mail']);
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
            $doctor->phoneNumbers = htmlspecialchars($_POST['phoneNumbers']);
        //si une valeur existe mais qu'elle est non conforme à la regexp, afficher le message d'erreur suivant : 
        }else {
            $formErrors['phoneNumbers'] = 'Votre numéro de telephone n\'est pas validee.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['phoneNumbers'] = 'Veuillez entrer votre numero de téléphone portable';
    }
    if(empty($_POST['password'])){
        $formErrors['password'] = "Veuillez renseigner un mot de passe";
        $isPasswordOk = false;
    }
    if(empty($_POST['passwordVerify'])){
        $formErrors['passwordVerify'] = "Veuillez renseigner le même mot de passe";
        $isPasswordOk = false;
    }
    //Si les vérifications des mots de passe sont ok
    if($isPasswordOk){
        if(Filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPwd)))) {
            //On hash le mot de passe avec la méthode de PHP
           if($_POST['passwordVerify'] == $_POST['password'] ){
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
           }
        }else{
            $formErrors['password'] = $formErrors['passwordVerify'] = "Le mot de passe ne correspond pas";
        }
    }

   if(!empty($_POST['practicePlace'])){
        //J'hydrate mon instance d'objet user
        $doctor->id_dom20_practiceplace = htmlspecialchars($_POST['practicePlace']);
    }else{
        $formErrors['practicePlace'] = '';
    }
    if(!isset($_POST['validate'])){
        $formErrors['validate'] = 'Pour finaliser votre inscription, veuillez accepter les CGU';
    }
    if(!isset($_POST['matricule'])){
      $formErrors['matricule'] = 'Veuillez entrer votre numero de maticule';
    }

    if (!empty($_POST['price'])) {
        //si une valeur existe, verifier qu'elle soit en accord avec la regexp
        if (filter_var($_POST['price'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPrice)))) {
            //si tout est ok, stocker la valeur dans dans une variable
            $doctor->price = htmlspecialchars($_POST['price']);
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
        $doctor->id_dom20_specialities =htmlspecialchars($_POST['specialitiesName']);
    }else{
        $formErrors['specialitiesName'] = '';
    }

    if(empty($formErrors)){ 
        if (!$user->checkMailUserDoctorExist()) {
            try {
                $user->role = 3;
                $user->beginTransaction();
                $user->addUser();
                $doctor->id_dom20_users = $user->getLastInsertId();
                $doctor->addDoctor();
                $_SESSION['profile']['id'] = $doctor->id_dom20_users;
                $_SESSION['profile']['mail'] = $user->mail;
                $_SESSION['profile']['doctorId'] = $user->getLastInsertId();
                $user->commit();
            }catch(Exception $e) {
                $user->rollBack();
            }
            $addDoctorMessage = 'Le Praticien a bien été enregistré';
            header('Location: profil-praticien.php?id=' . $doctor->id_dom20_users);
            exit;
            }else {
                $addDoctorMessage  = 'Le praticien existe deja';
        } 
    }

}


