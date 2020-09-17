<?php 
session_start();
include_once '../models/database.php';
include_once '../models/praticiens.php';
include_once '../models/users.php';
include_once '../controllers/liste-praticienController.php';
include_once 'header.php'
?>
        <main>
            <div class="container-fluid">
            <div class="row">
                <form action="liste-praticiens.php" method="POST" class="form-inline mx-auto">
                    <div class="form-group  m-3">
                        <input type="text" name="searchPatientRequest" class="form-control border rounded " id="searchPraticienRequest" placeholder="Rechercher un praticien">
                        <input type="date" name="searchbydate" id="searchbydate" class="form-control border rounded ">
                    </div>
                    <input type="submit" name="searchPraticien" value="rechercher" class=" btn btn-primary m-3">
                </form>
            </div>
                <div class="row">
                    <table class="table table-hover col-10  mx-auto table-striped table-fit">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Spécialité</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">Détails</th>
                                <th scope="col">Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($list as $praticienList) { ?>
                                    <tr>
                                        <td scope="row"><?= $praticienList->lastname ?></td>
                                        <td><?= $praticienList->firstname ?></td>
                                        <td><?= $praticienList->name?></td>
                                        <td><?= $praticienList->phone ?></td>
                                        <td><?= $praticienList->mail ?></td>
                                        <td>
                                            <a href="profil-praticien.php?id=<?= $praticienList->id ?>" title="profil praticien" class="btn btn-primary">Plus d'infos</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePraticienModal" data-patient="<?= $praticienList->id ?>">Supprimer le praticien</button>
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
                                            <a href="liste-praticiens.php?page=<?= $i ?>" class="btn <?= $i == $_GET['page'] ? 'btn-danger' : '' ?>"><?= $i ?></a>
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
                    <!-- Modal pour supprimer patient et ses Rdv -->
                    <div class="modal fade" id="deletePraticienModal" tabindex="-1" role="dialog" aria-labelledby="deletePraticienModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <form action="liste-praticien.php" method="POST">
                                    <button type="submit" class="btn btn-danger"id="delPraticienBtn" name="id">Supprimer le medecin</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </main>
<?php require 'footer.php' ?>