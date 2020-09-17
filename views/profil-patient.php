<?php
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/patients.php';
include '../controllers/profil-patientController.php';
include_once 'header.php';
?>
 <h1 class="text-center text-primary">Bienvenue sur votre espace</h1>
<div class="container-fluid">
    <div class="row"> 
        <div class="col-12 col-md-6 col-xl-6">   
            <div class="card-body card-body-cascade text-center">
                <div class="card" style="width: auto;">
                    <img class="card-img-top" src="../assets/img/manphone.jpg." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold blue-text pb-2">Votre Fiche</h5>
                        <p class="card-text"></p>
                    </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?= $users->lastname ?></li>
                    <li class="list-group-item"><?= $users->firstname ?></li>
                    <li class="list-group-item"><?= $users->birthDateFr ?></li>
                    <li class="list-group-item"><?= $users->phoneNumbers ?></li>
                    <li class="list-group-item"><?= $users->mail ?></li>
                </ul>
                <div class="card-body rounded-bottom mdb-color lighten-3">
                    <a href="modifier-patient.php" class="card-link white-text">Modifier</a>
                    <a href="profil-patient.php" class="ml-5 text-danger" data-toggle="modal" data-target="#deletePatientModal" data-patient="<?= $_SESSION['profile']['id'] ?>">Supprimer</a>
                </div>
                </div>
            </div>
        </div>
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
               <tbody><?php 
                    foreach($appointmentList as $appointment){ ?>
                    <tr>
                        <td><?= $appointment->doctor ?></td>
                        <td><?= $appointment->dateFr ?></td>
                        <td><?= $appointment->hour ?></td>
                    </tr><?php
                    } ?>
                </tbody>
            </table>
        </div>   
    </div>
</div>

<!-- Modal pour supprimer -->
<div class="modal fade" id="deletePatientModal" tabindex="-1" role="dialog" aria-labelledby="deletePatientModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Vous souhaitez supprimer votre compte </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <form action="profil-patient?id=<?=$_SESSION['id']?>" method="POST">
                                        <button type="submit" class="btn btn-danger" id="delPatientBtn" name="deleteProfilPatient">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include 'footer.php';