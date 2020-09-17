<?php
$formErrors = [];
//Vérification du formulaire de connexion
if(isset($_POST['login'])){
    $user = new users();
    if(!empty($_POST['mail'])){
        if(filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
            //J'hydrate mon instance d'objet user
            $user->mail = htmlspecialchars($_POST['mail']);
        }else{
            $formErrors['mail'] = 'Adresse mail incorrect';
        }
    }else{
        $formErrors['mail'] ='Veuillez saisir votre adresse mail';
    }

    if(empty($_POST['password'])){        
        $formErrors['password'] = 'Veuillez saisir votre mot de passe';
    }
    if(empty($formErrors)){

        //On récupère le hash de l'utilisateur
       $hash = $user->getUserPasswordHash();

       //Si le hash correspond au mot de passe saisi
       if(password_verify($_POST['password'], $hash)){
           //On récupère son profil
            $getUserProfile = $user->getUserProfile();

            //On met en session ses informations
            $_SESSION['profile']['id'] = $getUserProfile->id;
            $_SESSION['profile']['mail'] = $getUserProfile->mail;

            $doctor = new doctor();
            $doctor->id_dom20_users = $getUserProfile->id;
            if($doctor->checkUserUnavailabilityByFieldName('id_dom20_users')){
                $_SESSION['profile']['doctorId'] = 22;
                //On redirige vers une autre page.
                header('Location: profil-praticien.php');
                exit;
            }

            $patient = new patients();
            $patient->id_dom20_users = $getUserProfile->id;
            if($patient->checkUserUnavailabilityByFieldName('id_dom20_users')){
                $_SESSION['profile']['patientId'] = 22;
                       //On redirige vers une autre page.
                       header('Location: profil-patient.php');
                       exit;
            }

         


       }else{
           $formErrors['password'] = $formErrors['mail'] = 'Veuillez saisir vos identifiants';
       }
    }
}