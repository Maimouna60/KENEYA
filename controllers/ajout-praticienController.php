<?php
$formErrors = array();
$regexpPwd = '%^[0-9a-zA-Z]+$%';
//verification formulaire pour ajouter un patient
if(isset($_POST['addPatricien'])){
    //instancier notre requete de la class patients
    $patient = new patients();
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $praticien->mail = htmlspecialchars($_POST['mail']);
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
            $praticien->lastname = htmlspecialchars($_POST['lastname']);
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
            $praticien->firstname = htmlspecialchars($_POST['firstname']);
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
            $praticien->phone = htmlspecialchars($_POST['phoneNumbers']);
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
    if(empty($formErrors)){
        //on appelle la methode de notre addPatient pour creer un nouveau patient dans la base de données
        if($patient->addPatient()){
            $addPraticienMessage = 'LE Praticien A BIEN ETE ENREGISTE'; 
        }else{
            $addPraticientMessage = 'UNE ERREUR EST SURVENUE PANDANT L \'ENREGISTREMENT.VEUILLEZ CONTACTER LE SERVICE INFORMATIQUE.';    
        }       
    }
    if(!empty($_POST['email'])){
      if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
          $mail = htmlspecialchars($_POST['email']);
          $newUser->mail = $mail;
          if($newUser->checkMailExist()){
              $formErrors['email'] = 'Cette adresse mail est déjà utilisé';
          }else{
              (isset($_POST['emailConfirm']) && $_POST['emailConfirm'] == $mail )? '': $formErrors['emailConfirm'] = 'l\'e-mail de confirmation ne correspond pas à votre e-mail';
          }
      }else{
          $formErrors['email'] = 'Cette adresse n\'est pas valide ';
      }
      }else{
          $formErrors['email'] = 'Vous n\'avez indiqué votre adresse e-mail';
      }
    if(!empty($_POST['password'])){
        if(preg_match($passwordRegex,$_POST['password'])){
            $password = htmlspecialchars($_POST['password']);
            if(isset($_POST['passwordConfirm']) && $_POST['passwordConfirm'] == $password){
                $newUser->password = password_hash($password, PASSWORD_DEFAULT);
            }else {
                $formErrors['passwordConfirm'] = 'Le mot de passe de confirmation ne correspond pas à votre mot de passe';
            }
        }else{
            $formErrors['password'] = 'Votre mot de passe doit être de la forme : ';
        }
    }else{
        $formErrors['password'] = 'Vous n\'avez pas choisi de mot de passe';
    }
    if(!isset($_POST['validate'])){
        $formErrors['validate'] = 'Pour finaliser votre inscription, veuillez accepter les CGU';
    }
    if (empty($formErrors)) {
        if (!$praticien->checkPraticienExist()){
            if(!$patient->addPatient()){
               $addPraticientMessage = 'le praticien a été ajouté.'; 
            } else {
                $addPraticienMessage = 'Une erreur est survenue.';
            }
        } else {
            $addPraticienMessage = 'Le praticien a déjà été ajouté.';
        }
    }
}