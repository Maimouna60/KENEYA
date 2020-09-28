<?php
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/praticiens.php';
include_once '../models/specialities.php';
include_once '../models/practiceplace.php';
include '../controllers/modifier-profilPraticienController.php'; 
include_once 'header.php';
?>

<h1 class="text-center text-primary">Modifier vos informations</h1>
<div class="container-fluid">
    <div class="row"> 
        <form class="col-12 col-md-6 col-xl-6" id="modifier-profil" action="modifier-praticien.php<?= isset($_GET['doctorId']) ? '?doctorId=' . $_GET['doctorId'] : '' ?>"  method="POST">   
            <div class="card-body card-body-cascade text-center">
                <div class="card" style="width: auto;">
                        <img class="card-img-top" src="../assets/img/docteurF.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold blue-text pb-2">Votre Fiche</h5>
                            <p class="card-text"></p>
                        </div>
                    <?php if(isset($_SESSION['profile']['id'])){ ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="lastname">Nom :</label>
                                <input id="lastname" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['lastname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : $users->lastname ?>" type="text" name="lastname" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['lastname']) ? $formErrors['lastname'] : '' ?></p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="firstname">Prénom :</label>
                                <input id="firstname" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['firstname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : $users->firstname ?>" type="text" name="firstname" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['firstname']) ? $formErrors['firstname'] : '' ?></p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="phoneNumbers">Numéro de téléphone :</label>
                                <input id="phoneNumbers" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['phoneNumbers']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['phoneNumbers']) ? $_POST['phoneNumbers'] : $users->phoneNumbers ?>" type="tel" name="phoneNumbers" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['phoneNumbers']) ? $formErrors['phoneNumbers'] : '' ?></p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <select class="form-control custom-select" placeholder="spécialité" name="specialitiesName" required >
                                    <option disabled selected >Spécialité :</option> 
                                    <?php foreach($specialitiesName as $specialitieName) { ?>
                                    <option value="<?=$specialitieName->id?>" <?= isset($_POST['specialitiesName']) && $_POST['specialitiesName'] == $specialitieName->id || $users->id_dom20_specialities == $specialitieName->id ? 'selected' : '' ?>><?=$specialitieName->name?></option>
                                    <?php } ?>
                                </select>
                            </div>           
                        </li>                        
                        <li class="list-group-item">
                            <div class="form-group">
                                <select class="form-control custom-select" placeholder="practicePlace" name="practicePlace" required>
                                    <option disabled selected >Clinique/hopital : </option> 
                                    <?php foreach($practicesPlace as $practicePlace){?>
                                    <option value="<?=$practicePlace->id?>" <?= isset($_POST['practicePlace']) && $_POST['practicePlace'] == $practicePlace->id || $users->id_dom20_practiceplace == $practicePlace->id ? 'selected' : '' ?>><?=$practicePlace->placename?></option>
                                    <?php } ?>
                                </select>
                                <small id="practicePlaceHelp" class="form-text text-muted">Merci de renseigner le de votre etablissement</small>
                            </div> 
                        </li>                        
                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="mail">E-mail :</label>
                                <input id="mail" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['mail']) ? $_POST['mail'] : $users->mail ?>" type="email" name="mail" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['mail']) ? $formErrors['mail'] : '' ?></p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                               <label for="price">Prix de la consultation:</label>
                                <input id="price" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['price']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['price']) ? $_POST['price'] : $users->price ?>" type="text" name="price" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['price']) ? $formErrors['price'] : '' ?></p>
                            </div>
                        </li>
                    </ul>
                    <input type="submit" class="btn btn-primary" name="modify" value="Enregistrer"></input>
                    <p class="formOk text-danger"><?= isset($modifyDoctorMessage) ? $modifyDoctorMessage : '' ?></p><?php
                    }else { ?>
                    <p><?= $message ?></p>
                    <?php } ?>
                </div>
            </div> 
        </form>
        <div class="col-12 col-md-6 col-xl-6">
            <table class="table table-striped text-center container">
                <h4 class="text-center mt-5">Liste des rendez-vous</h4>
                <thead>
                    <tr>
                       <th scope="col">Medecin consulté :</th>
                        <th scope="col">Date du RDV :</th>
                        <th scope="col">Heure du RDV :</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <?php 
                    foreach($appointmentList as $appointment){ ?>
                    <tr>
                        <td><?= $appointment->doctor ?></td>
                        <td><?= $appointment->dateFr ?></td>
                        <td><?= $appointment->hour ?></td>
                    </tr>
                    <?php } ?> -->
                </tbody>
            </table>
        </div>   
    </div>
</div>

<?php include 'footer.php';
