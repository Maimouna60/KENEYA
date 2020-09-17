<?php 
session_start();
include_once '../models/database.php';
include_once '../models/patient.php';
include_once '../models/appointement.php';
include_once '../controlers/rendezvous.php';
include_once 'header.php';
?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="detail d-flex justify-content-center">
                            <ul class="patientDetail">
                                <li><strong>Date : </strong><?= $rendezvous->dateFR?></li>
                                <li><strong>Heure du rendez-vous : </strong><?= $rendezvous->timeFR?></li>
                                <li><strong>Nom : </strong><?= $rendezvous->lastname?><li>
                                <li><strong>Prénom : </strong><?= $rendezvous->firstname?></li>
                                <li><strong>Numéro de tel : </strong><?= $rendezvous->phone?></li>
                                <li><strong>Mail : </strong><?= $rendezvous->mail?></li>
                                <li><a href="modify-rendezvous.php?id=<?= $rendezvous->id ?>" title="modifier rendezvous" class="btn btn-primary my-3">modifier le rendez-vous</a></li>
                                <li><a href="liste-rendezvous.php" class="btn btn-primary">Retour</a></li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>

            
        </main>
<?php require 'footer.php' ?>