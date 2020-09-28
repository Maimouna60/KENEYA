<?php
//Si je ne suis pas connectée, je suis renvoyée vers l'index
if (!isset($_SESSION['profile']['id'])) {
    header('Location: ../index.php');
    exit;
} else {
    //Si je suis un patient ou un administrateur je peux accéder à la page, sinon je suis renvoyée 
    if (isset($_SESSION['profile']['patientId']) || $_SESSION['profile']['role'] == 2) {

        $patient = new patients();

        $patient->id = (!empty($_GET['patientId']) ? htmlspecialchars($_GET['patientId']) : $_SESSION['profile']['patientId']);

        if ($patient->checkUserUnavailabilityByFieldName('id')) {
            $formErrors = array();

            if (isset($_POST['modify'])) {
                $modifyUsersQuery = new users();
                $modifyPatientQuery = new patients();
        
                $modifyUsersQuery->id = $patient->getUserIdById()->id_dom20_users;
                $modifyPatientQuery->id_dom20_users = $modifyUsersQuery->id;
            
                if (!$modifyUsersQuery->checkUserUnavailabilityByFieldName('id')) {
                    header('Location: ../index.php');
                    exit;
                }
                        
                $regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
                $regexpPwd = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
                $regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';
                $regexpDate = '/^((19([0-9]{2}))|(20([0-1]{1}[0-9]{1}))){1}(\-)((0([1-9]{1}))|(1([0-2]{1})))(\-)((0([1-9]){1})|([1-2]{1}[0-9]{1})|(3([0-1]{1})))$/';

                //instancier notre requete de la class patients
                if (!empty($_POST['mail'])) {
                    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                        $modifyUsersQuery->mail = htmlspecialchars($_POST['mail']);
                    } else {
                        $formErrors['mail'] = 'Votre mail n\'est pas valide, veuillez utiliser le format : mai223@gmail.com';
                    }
                } else {
                    $formErrors['mail'] = 'Veuillez entrer votre adresse mail.';
                }
                if (!empty($_POST['lastname'])) {
                    //si une valeur existe, verifier qu'elle soit en accord avec la regexp
                    if (filter_var($_POST['lastname'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpName)))) {
                        //si tout est ok, stocker la valeur dans dans une variable
                        $modifyUsersQuery->lastname = htmlspecialchars($_POST['lastname']);
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
                        $modifyUsersQuery->firstname = htmlspecialchars($_POST['firstname']);
                        //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
                    } else {
                        $formErrors['firstname'] = 'Votre Prénom n\'est pas valide.';
                    }
                    //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
                } else {
                    $formErrors['firstname'] = 'Veuillez entrer votre Prénom.';
                }
                if (isset($_POST['phoneNumbers'])) {
                    //si une valeur existe, verifier qu'elle soit en accord avec la regexp
                    if (filter_var($_POST['phoneNumbers'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPhone)))) {
                        //si tout est ok, stocker la valeur dans dans une variable
                        $modifyPatientQuery->phoneNumbers = htmlspecialchars($_POST['phoneNumbers']);
                        //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
                    } else if (empty($_POST['phoneNumbers'])) {
                        $modifyPatientQuery->phoneNumbers = NULL;
                    } else {
                        $formErrors['phoneNumbers'] = 'Votre numéro de telephone n\'est pas valide.';
                    }
                    //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
                }
                if (!empty($_POST['birthdate'])) {
                    //si une valeur existe, verifier qu'elle soit en accord avec la regexp
                    if (filter_var($_POST['birthdate'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpDate)))) {
                        //si tout est ok, stocker la valeur dans dans une variable
                        $modifyPatientQuery->birthDate = htmlspecialchars($_POST['birthdate']);
                        //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
                    } else {
                        $formErrors['birthDate'] = 'Votre date de naissance n\'est pas valide.';
                    }
                    //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
                } else {
                    $formErrors['birthDate'] = 'Veuillez entrer votre date de naissance.';
                }
            
                if (empty($formErrors)) {
                    try {
                        $modifyUsersQuery->beginTransaction();
                        $modifyPatientQuery->modifyPatient();
                        $modifyUsersQuery->modifyUsers();
                        $modifyUsersQuery->commit();
                        $modifyPatientMessage = 'La modification a bien été prise en compte';
                    } catch (Exception $e) {
                        $modifyUsersQuery->rollBack();
                        $modifyPatientMessage = 'UNE ERREUR EST SURVENUE PANDANT L \'ENREGISTREMENT.VEUILLEZ CONTACTER LE SERVICE INFORMATIQUE.';
                    }
                }
            }
            $users = $patient->getPatDetailsById();
        } else {
            //Soit message d'erreur, soit redirection : ici si le patient n'existe pas
        }
    } else {
        header('Location: ../index.php');
        exit();
    }
}