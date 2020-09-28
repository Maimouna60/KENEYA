<?php
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/patients.php';
include '../controllers/modifier-profilPatientController.php'; 
include_once 'header.php';
?>

<h1 class="text-center text-primary">Modifier vos informations</h1>
<div class="container-fluid">
    <div class="row"> 
        <form class="col-12 col-md-6 col-xl-6" id="modifier-profil" action="modifier-patient.php<?= isset($_GET['patientId']) ? '?patientId=' . $_GET['patientId'] : '' ?>" method="POST">   
            <div class="card-body card-body-cascade text-center">
                <div class="card" style="width: auto;">
                        <img class="card-img-top" src="../assets/img/manphone.jpg." alt="Card image cap">
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
                                <label for="birthdate">Date de naissance:</label>
                                <input id="birthdate"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['birthdate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : $users->birthDate ?>" type="date" name="birthdate"  />
                                <?php if (isset($formErrors['birthdate'])) { ?>
                                <p class="errorForm"><?= isset($formErrors['birthdate']) ? $formErrors['birthdate'] : '' ?></p>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="phoneNumbers">Numéros de téléphone :</label>
                                <input id="phoneNumbers" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['phoneNumbers']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['phoneNumbers']) ? $_POST['phoneNumbers'] : $users->phoneNumbers ?>" type="tel" name="phoneNumbers" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['phoneNumbers']) ? $formErrors['phoneNumbers'] : '' ?></p>
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
                    </ul>
                    <input type="submit" class="btn btn-primary" name="modify" value="Enregistrer"></input>
                    <p class="formOk text-danger"><?= isset($modifyPatientMessage) ? $modifyPatientMessage : '' ?></p><?php
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
                    // foreach($appointmentList as $appointment){ ?>
                    // <tr>
                    //     <td><?= $appointment->doctor ?></td>
                    //     <td><?= $appointment->dateFr ?></td>
                    //     <td><?= $appointment->hour ?></td>
                    // </tr><?php
                    // } ?> -->
                </tbody>
            </table>
        </div>   
    </div>
</div>


<?php include 'footer.php';