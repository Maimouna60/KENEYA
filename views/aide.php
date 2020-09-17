<?php
include 'header.php';
include '../models/database.php';
include '../models/user.php';
include_once '../models/patients.php';
include '../controllers/ajout-patientController.php'; 
?>
<div class="container-fluid"> 
    <div class="row mt-4">
        <div class=" col-6 mx-auto">
            <form id="ajout-patient" action="ajout-patient.php" method="POST">
                <div class="row ">
                <p class="text-<?= (isset($addPatientMessage) && $addPatientMessage == 'Le patient a bien été enregistré')  ? 'success' : 'danger' ?>"><?= isset($_POST['formContactSend']) ? $addPatientMessage : ''; ?></p>
                    <div class="col-12 col-md-6 col-xl-6"> 
                        <label for="lastname">Nom :</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Does" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>">
                        <!--message d'erreur-->
                        <?php if (isset($formErrors['lastname'])) { ?>
                    <p class="text-danger ml-3"><?= $formErrors['lastname'] ?></^>
                    <?php } ?>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <label for="firstname">Prénom :</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="John" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
                        <?php if (isset($formErrors['firstname'])) { ?>
                        <p class="text-danger ml-3"><?= $formErrors['firstname'] ?></p>
                        <?php } ?>
                    </div>
                </div> 
                    <div class="row ">
                        <div class="col-12 col-md-6 col-xl-6">
                            <label for="birthdate">Date de naissance :</label>
                            <input type="date" class="form-control" id="birthDate" name="birthDate">                       
                            <?php if (isset($formErrors['birthDate'])) { ?>
                            <p class="text-danger ml-3"><?= $formErrors['birthDate'] ?></p>
                            <?php } ?>
                        </div>                  
                        <div class="col-12 col-md-6 col-xl-6">
                            <label for="phoneNumbers">Numéros de téléphone :</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="00 223 66 65 76 76" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>">                  
                            <?php if (isset($formErrors['phone'])) { ?>
                            <p class="text-danger ml-3"><?= $formErrors['phone'] ?></p>
                            <?php } ?>
                        </div>
                    </div>
                        <div class="row ">
                            <div class="col-12 col-md-6 col-xl-6">
                                <label for="mail">Adresse e-mail :</label>
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="Mai@gmail.com" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>">
                        <?php if (isset($formErrors['mail'])) { ?>
                        <p class="text-danger ml-3"><?= $formErrors['mail'] ?></p>
                        <?php } ?>
                            </div>
                        <!-- Confirmation Email -->
                        <div class="col-12 col-md-6 col-xl-6"> 
                            <label for="password">Mot de passe : </label>
                            <input id="password" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" type="password" name="password" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['password']) ? $formErrors['password'] : '' ?></p>
                        </div>
                        </div>
                        controlleur

                        //verification formulaire pour ajouter un patient
/*if(isset($_POST['addPatient'])){
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
            $user->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $arrayErrors= array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            try {
                $user->role = 3;
                $user->db->beginTransaction();
                $user->addUser();
                $userId = $user->db->lastInsertId();
                
                $patient->id_dom20_users = $userId;
                $patient->addPatient();
                $addPatientMessage = 'le patient a été ajouté.'; 
                $user->db->commit();
            } 
            catch (Exception $e) {
                //if ($user->db->inTransaction()) {
                    $user->db->rollback();
                //}
                throw $e;
            }
        } else {
            $addPatientMessage = 'Le patient a déjà été ajouté.';
        }
    }
}*/