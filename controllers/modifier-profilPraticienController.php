<?php

if (!isset($_SESSION['profile']['id'])) {
    header('Location: ../index.php');
    exit;
}else {
    //Si je suis un docteur ou un administrateur je peux accéder à la page, sinon je suis renvoyée 
    if (isset($_SESSION['profile']['doctorId']) || $_SESSION['profile']['role'] == 2) {

        $doctor = new doctor();
        $specialities = new specialities();
        $specialitiesName = $specialities->getSpecialitiesName();
        $placename = new practiceplace();
        $practicesPlace = $placename->getPracticesPlaceName();

        $doctor->id = (!empty($_GET['doctorId']) ? htmlspecialchars($_GET['doctorId']) : $_SESSION['profile']['doctorId']);

        if ($doctor->checkUserUnavailabilityByFieldName('id')) {
        $formErrors = array();

            if (isset($_POST['modify'])) {
                $modifyUsersQuery = new users();
                $modifyDoctorQuery = new doctor();
        
                $modifyUsersQuery->id = $doctor->getUserIdById()->id_dom20_users;
                $modifyDoctorQuery->id_dom20_users = $modifyUsersQuery->id;
            
                if (!$modifyUsersQuery->checkUserUnavailabilityByFieldName('id')) {
                    header('Location: ../index.php');
                    exit;
                }
                        
                $regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
                $regexpPwd = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
                $regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';
                $regexpDate = '/^((19([0-9]{2}))|(20([0-1]{1}[0-9]{1}))){1}(\-)((0([1-9]{1}))|(1([0-2]{1})))(\-)((0([1-9]){1})|([1-2]{1}[0-9]{1})|(3([0-1]{1})))$/';
                $regexpPrice = '/^[1-9]([0-9]{3,4})$/';
                    


                //instancier notre requete de la class Doctor
                if (!empty($_POST['mail'])) {
                    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                        $modifyUsersQuery->mail = htmlspecialchars($_POST['mail']);
                    } else {
                        $formErrors['mail'] = 'Votre mail n\'est pas valide, veuillez utiliser le format : Dr.Sy@gmail.com';
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

                if (!empty($_POST['phoneNumbers'])) {
                    //si une valeur existe, verifier qu'elle soit en accord avec la regexp
                    if (filter_var($_POST['phoneNumbers'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPhone)))) {
                        //si tout est ok, stocker la valeur dans dans une variable
                        $modifyDoctorQuery->phoneNumbers = htmlspecialchars($_POST['phoneNumbers']);
                        //si une valeur existe mais qu'elle est non conforme à la regexp, afficher le message d'erreur suivant : 
                    } else {
                        $formErrors['phoneNumbers'] = 'Votre numéro de telephone n\'est pas validee.';
                    }
                    //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
                } else {
                    $formErrors['phoneNumbers'] = 'Veuillez entrer votre numero de téléphone portable';
                }

                if (!empty($_POST['practicePlace'])) {
                    //J'hydrate mon instance d'objet user
                    $modifyDoctorQuery->id_dom20_practiceplace = htmlspecialchars($_POST['practicePlace']);
                } else {
                    $formErrors['practicePlace'] = '';
                }

                if (!empty($_POST['price'])) {
                    //si une valeur existe, verifier qu'elle soit en accord avec la regexp
                    if (filter_var($_POST['price'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpPrice)))) {
                        //si tout est ok, stocker la valeur dans dans une variable
                        $modifyDoctorQuery->price = htmlspecialchars($_POST['price']);
                        //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
                    } else {
                        $formErrors['price'] = 'Le montant n\'est pas valide.';
                    }
                    //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
                } else {
                    $formErrors['price'] = 'Veuillez entrer le prix de vos consultations.';
                }

                if (!empty($_POST['specialitiesName'])) {
                    //J'hydrate mon instance d'objet user
                    $modifyDoctorQuery->id_dom20_specialities = htmlspecialchars($_POST['specialitiesName']);
                } else {
                    $formErrors['specialitiesName'] = '';
                }

                if (empty($formErrors)) {
                    try {
                        $modifyUsersQuery->beginTransaction();
                        $modifyDoctorQuery->modifyDoctor();
                        $modifyUsersQuery->modifyUsers();
                        $modifyUsersQuery->commit();
                        $modifyDoctorMessage = 'La modification a bien été prise en compte';
                    } catch (Exception $e) {
                        $modifyUsersQuery->rollBack();
                        $modifyDoctorMessage = 'UNE ERREUR EST SURVENUE PANDANT L \'ENREGISTREMENT.VEUILLEZ CONTACTER LE SERVICE INFORMATIQUE.';
                    }
                }
            }
            $users = $doctor->getDocDetailsById();
        } else {
            //Soit message d'erreur, soit redirection : ici si le patient n'existe pas
        }
    } else {
    header('Location: ../index.php');
    exit();
    }
}
// $doctor->id = $_GET['doctorId'];


