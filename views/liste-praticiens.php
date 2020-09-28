<?php 
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/praticiens.php';
include_once '../controllers/liste-praticienController.php';
include_once 'header.php'
?>
        <main>
            <div class="container-fluid">
            <div class="row">
                <form action="liste-praticiens.php?page=1" method="POST" class="form-inline mx-auto">
                    <div class="form-group  m-3">
                        <input type="text" name="searchDoctorRequest" class="form-control border rounded  mr-3" id="searchDoctorRequest" placeholder="Rechercher un praticien par nom" size="30">
                        <p class="m-3">ou</p>  
                        <input type="mail" name="searchbyMail" id="searchbyMail" class="form-control border rounded" placeholder="Rechercher un praticien par mail" size="30">
                    </div>
                    <input type="submit" name="searchDoctor" value="rechercher" class=" btn btn-primary m-3">
                </form>
            </div>
                <div class="row">
                    <table class="table table-hover col-10  mx-auto table-striped table-fit">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Spécialité</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">Profil</th>
                                <th scope="col">Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($list as $doctorList) { ?>
                                    <tr>
                                        <td scope="row"><?= $doctorList->lastname ?></td>
                                        <td><?= $doctorList->firstname ?></td>
                                        <td><?= $doctorList->name ?></td>  
                                        <td><?= $doctorList->mail ?></td>
                                        <td>
                                            <a href="modifier-praticien.php?doctorId=<?= $doctorList->docId ?>" title="profil praticien" class="btn btn-primary btn-rounded">Profil Praticien </a>
                                        </td>
                                        <td>
                                            <a href="profil-praticien.php" class="btn btn-danger btn-rounded" name="deleteProfilDoctor" data-toggle="modal" data-target="#deleteDoctorModal" data-iduser="<?= $doctorList->usid ?>">Supprimer</a>
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
                                            <a href="liste-praticiens.php?page=1" class="btn"><<</a>
                                            <a href="liste-praticiens.php?page=<?=($page - 1)?>" class="btn"><</a>
                                        <?php }
                                        if ($page > 4){ ?>
                                            <span>...</span>
                                        <?php }
                                        $endPage = $page + 3;
                                        if($endPage > $pageNumber) {
                                            $endPage = $pageNumber;
                                        }
                                        for ($i = $beginPage; $i <= $endPage; $i++) {?>
                                            <a href="liste-praticiens.php?page=<?= $i ?>" class="btn <?= $i == $_GET['page'] ? 'btn-primary' : '' ?>"><?= $i ?></a>
                                    <?php } 
                                    if ($page < $pageNumber - 3){ ?>
                                        <span>...</span>
                                    <?php }
                                    if ($page != $pageNumber){ ?>
                                        <a href="liste-praticiens.php?page=<?=($page + 1) ?>" class="btn">></a>
                                        <a href="liste-praticiens.php?page=<?= $pageNumber ?>" class="btn">>></a>
                                    <?php }
                                    ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- Modal pour supprimer praticien et ses Rdv -->
                    <div class="modal fade" id="deleteDoctorModal" tabindex="-1" role="dialog" aria-labelledby="deleteDoctorModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Vous souhaitez supprimer ce compte </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <form action="liste-praticiens.php?page=1" method="POST">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label"></label>
                                        <input type="hidden" class="form-control" name="deleteUser" id="recipient-name" value="" />
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-danger" id="delDoctorBtn" name="deleteProfilDoctor"  value="supprimer">Supprimer le praticien </button>
                                    </div>   
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
<?php include_once 'footer.php' ?>


              
               