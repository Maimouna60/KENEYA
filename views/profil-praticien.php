<?php
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/praticiens.php';
include_once '../models/specialities.php';
include_once '../models/practiceplace.php';
include '../controllers/profil-praticienController.php';
include_once 'header.php';
?>
  <h1 class="text-center text-primary mt-4">Votre espace</h1>
<div class="container-fluid">

    <div class="row"> 
        <div class="col-12 col-md-6 col-xl-6">
            <div class="card-body card-body-cascade text-center">
                <div class="card" style="width: auto;">
                    <img class="card-img-top" src="../assets/img/docteurF.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold blue-text pb-2">Votre Fiche</h5>
                        <p class="card-text"></p>
                    </div>
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item"><?= $users->lastname ?></li>
                        <li class="list-group-item"><?= $users->firstname ?></li>
                        <li class="list-group-item"><?= $users->phoneNumbers ?></li>
                        <li class="list-group-item"><?= $users->name ?></li>
                        <li class="list-group-item"><?= $users->placename ?></li>
                        <li class="list-group-item"><?= $users->mail ?></li>
                        <li class="list-group-item"><?= $users->price ?> Fcfa</li>
                    </ul>
                    <div class="card-body rounded-bottom mdb-color lighten-3 ">
                        <a href="modifier-praticien.php" class="card-link white-text mr-5">Modifier</a>
                        <a href="profil-praticien.php" class="ml-5 text-danger" data-toggle="modal" data-target="#deleteDoctorModal" data-praticien="<?= $_SESSION['profile']['id'] ?>">Supprimer</a>
                    </div>
               </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-6">
            <table class="table table-striped text-center container">
                <h4 class="text-center mt-5">Planning </h4>
                <thead>
                    <tr>
                        <th scope="col">Patient :</th>
                        <th scope="col">Date du RDV :</th>
                        <th scope="col">Heure du RDV :</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><button><a href="profil-praticien.php"> Fiche Patient</a></button></td>
                        <td>date</td>
                        <td>heure</td>
                    </tr>
                  
                </tbody>
            </table>
        </div>   
    </div>
</div>
<!-- Modal pour supprimer -->
<div class="modal fade" id="deleteDoctorModal" tabindex="-1" role="dialog" aria-labelledby="deleteDoctorModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Vous souhaitez supprimer votre compte </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <form action="profil-praticien" method="POST">
                                    <button type="submit" class="btn btn-danger" id="deldrBtn" name="deleteProfilDoctor">Supprimer</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
<?php include 'footer.php';

