<?php 
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/patients.php';
include_once '../controllers/liste-patientController.php';
include_once 'header.php'
?>
    <div class="liste ">
        <main>
            <div class="container-fluid">
            <div class="row">
                <form action="liste-patients.php?page=1" method="POST" class="form-inline mx-auto">
                    <div class="form-group  m-4">
                        <input type="text" name="searchPatientRequest" class="form-control border rounded mr-3 " id="searchPatientRequest" placeholder="Rechercher un patient par nom" size="30">
                        <p class="m-3">ou</p>       
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
                                        <a href="modifier-patient.php?patientId=<?= $patientList->id ?>"title="profil patient" class="btn btn-primary btn-rounded">Profil Patient </a>
                                    </td>
                                    <td>
                                        <a href="profil-patient.php" title="profil patient" class="btn btn-danger btn-rounded" data-toggle="modal" data-target="#deletePatientModal" data-iduser="<?= $patientList->usid ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php } ?>   
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <?php //affiche le numero des page
                                        $beginPage = $page - 3;
                                        if($beginPage < 1){
                                            $beginPage = 1;
                                        }
                                        if ($page != 1){ ?>
                                            <a href="liste-patients.php?page=1" class="btn"><<</a>
                                            <a href="liste-patients.php?page=<?=($page - 1)?>" class="btn"><</a>
                                        <?php }
                                        if ($page > 4){ ?>
                                            <span>...</span>
                                        <?php }
                                        $endPage = $page + 3;
                                        if($endPage > $pageNumber) {
                                            $endPage = $pageNumber;
                                        }
                                        for ($i = $beginPage; $i <= $endPage; $i++) {?>
                                        <!-- isset -->
                                            <a href="liste-patients.php?page=<?= $i ?>" class="btn <?= $i == $_GET['page'] ? 'btn-primary' : '' ?>"><?= $i ?></a>
                                    <?php } 
                                    if ($page < $pageNumber - 3){ ?>
                                        <span>...</span>
                                    <?php }
                                    if ($page != $pageNumber){ ?>
                                        <a href="liste-patients.php?page=<?=($page + 1) ?>" class="btn">></a>
                                        <a href="liste-patients.php?page=<?= $pageNumber ?>" class="btn">>></a>
                                    <?php }
                                    ?>
                                </td>
                            </tr>
                        </tfoot>
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
                            <div class="modal-footer d-flex justify-content-center">
                                <form action="liste-patients.php?page=1" method="POST">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label"></label>
                                        <input type="hidden" class="form-control" name="deleteUser" id="recipient-name" value="" />
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-danger" id="delPatientBtn" name="deleteProfilPatient"  value="supprimer">Supprimer le patient </button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </main>


<?php include 'footer.php';

