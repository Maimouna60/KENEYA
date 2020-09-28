<?php 
session_start();
include_once '../models/database.php';
include_once '../models/appointment.php';
include_once '../models/users.php';
include_once '../models/praticiens.php';
include_once '../controllers/ajout-rdvController.php';
include_once 'header.php'
?>

    <main>
        <div class="container">
            <form action="ajout-rendezvous.php" method="POST" class="addAppointementForm">
            
                <h1 class="mb-3">Ajouter un rendez-vous :</h1>
                <p class="text-<?= (isset($addAppointementMessage) && $addAppointementMessage == 'Le rendez-vous a bien été enregistré')  ? 'success' : 'danger' ?>"><?= isset($_POST['formAppointementSend']) ? $addAppointementMessage : ''; ?></p>
                
                <div class="form-group row">
                    <label for="appointementDate" class="col-3 col-form-label col-form-label">Date :</label>
                    <div class="col-9">
                        <input type="date" class="form-control" id="appointementDate" name="appointementDate"  value="<?= isset($_POST['appointementDate']) ? $_POST['appointementDate'] : '' ?>">
                    </div>
                    <?php if (isset($formErrors['appointementDate'])) { ?>
                    <p class="text-danger ml-3"><?= $formErrors['appointementDate'] ?></^>
                    <?php } ?>
                </div>

                <div class="form-group row">
                    <label for="appointementTime" class="col-3 col-form-label col-form-label">Horaire :</label>
                    <div class="col-9">
                        <input type="time" name="appointementTime">
                    </div>
                    <?php if (isset($formErrors['appointementTime'])) { ?>
                    <p class="text-danger ml-3"><?= $formErrors['appointementTime'] ?></p>
                    <?php } ?>
                </div>
                
                <div class="form-group row">
                    <label for="patientId" class="col-3 col-form-label col-form-label">Nom du Praticien :</label>
                    <div class="col-9">
                        <select name="doctorId" id="doctorId" class="timeAppointement">
                            <option selected disabled>Sélectionner un medecin</option>
                            <?php foreach($list as $doctorList) { ?>
                                <option value="<?= $doctorList->id ?>"><?= $doctorList->lastname . ' ' . $doctorList->firstname ?></option>
                            <?php } ?>   
                        </select>
                    </div>
                    <?php if (isset($formErrors['doctorId'])) { ?>
                    <p class="text-danger ml-3"><?= $formErrors['doctorId'] ?></p>
                    <?php } ?>
                </div>
                
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary my-3" name="formAppointementSend" >Enregister</button>
                </div>

            </form>
        </div>
    </main>

