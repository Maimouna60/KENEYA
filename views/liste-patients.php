<?php 
session_start();
include_once '../models/database.php';
include_once '../models/patients.php';
include_once '../models/users.php';
include_once '../controllers/liste-patientController.php';
include_once 'header.php'
?>
        <main>
            <div class="container-fluid">
            <div class="row">
                <form action="liste-patients.php" method="POST" class="form-inline mx-auto">
                    <div class="form-group  m-3">
                        <input type="text" name="searchPatientRequest" class="form-control border rounded mr-5 " id="searchPatientRequest" placeholder="Rechercher un patient">
                        <input type="date" name="searchbydate" id="searchbydate" class="form-control border rounded ">
                    </div>
                    <input type="submit" name="searchPatient" value="rechercher" class=" btn btn-primary m-3">
                </form>
            </div>
                <div class="row">
                    <table class="table table-hover col-10 mx-auto table-striped table-fit">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Date de naissance</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">Profil</th>
                                <th scope="col">Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($list as $patientList) { ?>
                                    <tr>
                                        <td scope="row"><?= $patientList->lastname ?></td>
                                        <td><?= $patientList->firstname ?></td>
                                        <td><?= $patientList->birthDateFr?></td>
                                        <td><?= $patientList->phoneNumbers ?></td>
                                        <td><?= $patientList->mail ?></td>
                                        <td>
                                            <a href="modifier-patient.php" class=" text-danger" title="profil patient" class="btn btn-primary">Profil Patient </a>
                                        </td>
                                        <td>
                                        <a href="profil-patient.php" class="ml-5 text-danger" data-toggle="modal" data-target="#deletePatientModal" data-patient="<?= $_SESSION['profile']['id'] ?>">Supprimer</a>
                                        </td>
                                    </tr>
                            <?php } ?>   
                        </tbody>

                    </table> 
                    <!--Modal pour supprimer patient et ses Rdv -->
                    <div class="modal fade" id="deletePatientModal" tabindex="-1" role="dialog" aria-labelledby="deletePatientModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Etes vous sure de vouloir supprimer ce patient?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <form action="liste-patients.php" method="POST">
                                    <button type="submit" class="btn btn-danger"id="delPatientBtn" name="id">Supprimer le patient </button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </main>

</div>
<?php include 'footer.php';