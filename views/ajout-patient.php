<?php
include 'header.php';
include '../models/database.php';
include '../models/user.php';
include_once '../models/patients.php';
include '../controllers/ajout-patientController.php'; 
?>
<div class="container-fluid"> 
    <div class="row ">
        <div class=" col-6 mx-auto">
            <form id="ajout-patient" action="ajout-patient.php" method="POST">
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label for="lastname">Nom :</label>
                            <input id="lastname" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['lastname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" type="text" name="lastname" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['lastname']) ? $formErrors['lastname'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Prénom :</label>
                            <input id="firstname" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['firstname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" type="text" name="firstname" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['firstname']) ? $formErrors['firstname'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Date de naissance :</label>
                            <input id="birthdate" type="date" name="birthdate" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['birthdate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : '' ?>" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['birthdate']) ? $formErrors['birthdate'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumbers">Numéros de téléphone :</label>
                            <input id="phoneNumbers"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['phoneNumbers']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['phoneNumbers']) ? $_POST['phoneNumbers'] : '' ?>" type="tel" name="phoneNumbers" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['phoneNumbers']) ? $formErrors['phoneNumbers'] : '' ?></p>
                        </div>
                        <div class="row text-uppercase">
                        <div class="col-12 col-md-6 col-xl-6">
                            <label for="mail">E-mail :</label>
                            <input id="mail" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>" type="email" name="mail" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['mail']) ? $formErrors['mail'] : '' ?></p>
                        </div>
                        <!-- Confirmation Email -->
                        <div class="col-12 col-md-6 col-xl-6"> 
                            <label for="password">Mot de passe : </label>
                            <input id="password" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" type="password" name="password" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['password']) ? $formErrors['password'] : '' ?></p>
                        </div>
                    </div>
                </div>
                    <div class="row text-uppercase">
                        <div class="col-12 col-md-6 col-xl-6"><input type="checkbox" name="validate" id="validate" />
                            <label for="validate">J'accepte les <a href="cgu">CGU.</a></label>
                            <small>KENEYA est le seul destinataire de vos données et s’engage à ne pas divulguer, ne pas transmettre, ni partager vos données personnelles avec d’autres entités.        
                            <p class="text-danger"> <?= isset($formErrors['validate']) ? $formErrors['validate'] : '' ?> </p>                       
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <input  type="submit" class="btn btn-primary text-center" name="addPatient" value="Enregistrer"></input>
                            <p class="formOk"><?= isset($addPatientMessage) ? $addPatientMessage : '' ?></p>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php';