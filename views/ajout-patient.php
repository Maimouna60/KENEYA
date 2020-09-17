 <?php
   session_start();
   include_once '../models/database.php';
   include_once '../models/users.php';
   include_once '../models/patients.php';
   include '../controllers/ajout-patientController.php';   
   include_once 'header.php';
?>
   <div class="container-fluid"> 
       <div class="row mt-4">
           <div class=" col-6 mx-auto">
               <form id="ajout-patient" action="ajout-patient.php" method="POST">
                   <div class="row ">
                   <p class="text-<?= (isset($addPatientMessage) && $addPatientMessage == 'Le patient a bien été enregistré')  ? 'success' : 'danger' ?>"><?= isset($_POST['formContactSend']) ? $addPatientMessage : ''; ?></p>
                       <div class="col-12 col-md-6 col-xl-6">
                           <label for="lastname">Nom :</label>
                            <input id="lastname"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['lastname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" type="text" name="lastname"  placeholder="KANTE" />
                            <?php if (isset($formErrors['lastname'])) { ?>
                            <p class="errorForm"><?= isset($formErrors['lastname']) ? $formErrors['lastname'] : '' ?></p>
                            <?php } ?>
                       </div>
                       <div class="col-12 col-md-6 col-xl-6">
                            <label for="firstname">Prénom :</label>
                            <input id="firstname"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['firstname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" type="text" name="firstname"  placeholder="Fatimata" />
                            <?php if (isset($formErrors['firstname'])) { ?>
                            <p class="errorForm"><?= isset($formErrors['firstname']) ? $formErrors['firstname'] : '' ?></p>
                            <?php } ?>
                        </div>
                    </div> 
                       <div class="row ">
                           <div class="col-12 col-md-6 col-xl-6">
                               <label for="birthdate">Date de naissance:</label>
                                <input id="birthdate"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['birthdate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : '' ?>" type="date" name="birthdate"  />
                                <?php if (isset($formErrors['birthdate'])) { ?>
                                <p class="errorForm"><?= isset($formErrors['firstname']) ? $formErrors['birthdate'] : '' ?></p>
                                <?php } ?>
                            </div>          
                            <div class="col-12 col-md-6 col-xl-6">
                               <label for="phoneNumbers">Numéros de téléphone :</label>
                               <input id="phoneNumbers"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['phoneNumbers']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['phoneNumbers']) ? $_POST['phoneNumbers'] : '' ?>" type="tel" name="phoneNumbers"  placeholder="00 223 66 66 66 66" />
                               <?php if (isset($formErrors['phoneNumbers'])) { ?>
                               <p class="errorForm"><?= isset($formErrors['phoneNumbers']) ? $formErrors['phoneNumbers'] : '' ?></p>
                               <?php } ?>
                            </div>
                       </div>
                        <div class="row ">
                            <div class="col-12 col-md-6 col-xl-6">
                                <label for="mail">Adresse e-mail :</label>
                                <input id="mail"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>" type="email" name="mail"  placeholder="fati@gmail.com" />
                                <?php if (isset($formErrors['mail'])) { ?>
                                <p class="errorForm"><?= isset($formErrors['mail']) ? $formErrors['mail'] : '' ?></p>
                                <?php } ?>
                            </div>
                            <div class="col-12 col-md-6 col-xl-6"> 
                                <label for="password">Mot de passe :</label>                           
                                <input id="password" aria-describedby="passwordHelp"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" type="password" name="password"  placeholder="xxxxxxxxx12" />
                                <?php if (isset($formErrors['password'])) { ?>
                                <p class="errorForm"><?= isset($formErrors['password']) ? $formErrors['password'] : '' ?></p>
                                <?php } else{ ?>         
                                <small id="passwordHelp" class="form-text text-muted">Merci de renseigner votre mot de passe avec 8 caractères, minimum 1 lettre et 1 chiffre.</small>
                                <?php } ?>
                            </div>
                        </div>
                       <div class="row">
                           <div class="col-12 col-md-6 col-xl-6">
                               <input type="checkbox" name="validate" id="validate" />
                               <label for="validate">J'accepte les <a href="cgu">CGU.</a></label>
                               <small>KENEYA est le seul destinataire de vos données et s’engage à ne pas divulguer, ne pas transmettre, ni partager vos données personnelles avec d’autres entités.        
                               <p class="text-danger"> <?= isset($formErrors['validate']) ? $formErrors['validate'] : '' ?> </p>                       
                           </div>
                           <div class="col-12 col-md-6 col-xl-6">
                               <input  type="submit" class="btn btn-primary text-center" name="addPatient" value="Enregistrer" />
                               <p class="formOk text-danger"><?= isset($addPatientMessage) ? $addPatientMessage : '' ?></p>
                           </div>
                       </div>
               </form>
           </div>
       </div>
   </div>
   <?php include 'footer.php';