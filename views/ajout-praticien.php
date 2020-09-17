<?php
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/praticiens.php';
include_once '../models/specialities.php';
include_once '../models/practiceplace.php';
include '../controllers/ajout-praticienController.php';
include_once 'header.php';
?>
<div class="container-fluid"> 
    <div class="row mt-5">
        <div class="col-6 mx-auto">
            <form id="ajout-praticien" action="ajout-praticien.php" method="POST">
                <div class="row">
                    <!--<div class="col-12"> -->  
                        <div class="col-12 col-md-6 col-xl-6">
                            <label for="lastname">Nom :</label>
                            <input id="lastname" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['lastname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" type="text" name="lastname"placeholder="DEMBELE" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['lastname']) ? $formErrors['lastname'] : '' ?></p>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <label for="firstname">Prénom :</label>
                            <input id="firstname" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['firstname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" type="text" name="firstname" placeholder="Fatimata"/>
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['firstname']) ? $formErrors['firstname'] : '' ?></p>
                        </div>
                </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-xl-6">
                            <label for="phoneNumbers">Numéros de téléphone:</label>
                            <input id="phoneNumbers"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['phoneNumbers']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['phoneNumbers']) ? $_POST['phoneNumbers'] : '' ?>" type="tel" name="phoneNumbers"  placeholder="00 223 66 66 66 66" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['phoneNumbers']) ? $formErrors['phoneNumbers'] : '' ?></p>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <label for="matricule">N° d'inscription à l'ordre des médecins :</label>
                            <input id="matricule"  class="form-control <?= !empty($_POST['matricule']) ? (isset($formErrors['matricule']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['matricule']) ? $_POST['matricule'] : '' ?>" type="text" name="matricule" placeholder="bko223KLLMKML"/>
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['matricule']) ? $formErrors['matricule'] : '' ?></p>
                        </div>
                    </div>
                 <div class="row">
                    <div class="col-12 col-md-6 col-xl-6 mb-4">
                        <select class="form-control custom-select" placeholder="practicePlace" name="practicePlace" required>
                            <option disabled selected >Clinique/hopital : </option> 
                            <?php foreach($practicesPlace as $practicePlace){?>
                                <!--ternaire raccourci-->
                            <option value="<?=$practicePlace->id?>" <?= !isset($_POST['practicePlace']) || $_POST['practicePlace'] != $practicePlace->id ?: 'selected' ?> ><?=$practicePlace->placename?></option>
                            <small id="practicePlaceHelp" class="form-text text-muted">Merci de renseigner le de votre etablissement</small>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6 mb-4">
                        <select class="form-control custom-select" placeholder="spécialité" name="specialitiesName" required>
                            <option disabled selected >Spécialité</option> 
                            <?php foreach($specialitiesName as $specialitieName){?>
                            <option value="<?=$specialitieName->id?>" <?= isset($_POST['specialitiesName']) && $_POST['specialitiesName'] == $specialitieName->id ? 'selected' : '' ?>><?=$specialitieName->name?></option>
                            <?php } ?>
                        </select>
                    </div>                   
                </div>    
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <label for="mail">Adresse e-mail :</label>
                        <input id="mail" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>" type="mail" name="mail" placeholder="fati@gmail.com" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['mail']) ? $formErrors['mail'] : '' ?></p>
                    </div>
                    
                    <div class="col-12 col-md-6 col-xl-6">
                        <label for="price">Prix de la consultation:</label>
                        <input id="price" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['price']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['price']) ? $_POST['price'] : '' ?>" type="text" name="price" placeholder="xxxx" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['price']) ? $formErrors['price'] : '' ?></p>
                    </div>
                </div>
                    <!--MOT DE PASSE -->
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-6">
                        <label for="password">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" aria-describedby="passwordHelp" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" placeholder="xxxxxxxxx12" />
                        <?php if(isset($formErrors['password'])){ ?>
                            <p class="text-danger"><?= $formErrors['password'] ?></p>
                        <?php }else{ ?>
                            <small id="passwordHelp" class="form-text text-muted">Merci de renseigner votre mot de passe avec 8 caractères, minimum 1 lettre et 1 chiffre.</small>
                            <?php } ?>
                    </div>                    
                    <div class="col-12 col-md-6 col-xl-6">
                       <label for="passwordVerify">Mot de passe (confirmation) :</label>
                        <input type="password" class="form-control" id="passwordVerify" aria-describedby="passwordVerifyHelp" name="passwordVerify" value="<?= isset($_POST['passwordVerify']) ? $_POST['passwordVerify'] : '' ?>" placeholder="xxxxxxxxx12"/>
                        <?php if(isset($formErrors['passwordVerify'])){ ?>
                            <p class="text-danger"><?= $formErrors['passwordVerify'] ?></p>
                        <?php }else{ ?>
                            <small id="passwordVerifyHelp" class="form-text text-muted">Merci de confirmer votre mot de passe</small>
                            <?php } ?>
                    </div>  
                </div>
                <div class="row ">
                    <div class="col-12 col-md-6 col-xl-6"><input type="checkbox" name="validate" id="validate" />
                        <label for="validate">J'accepte les <a href="cgu">CGU.</a></label>
                        <small>KENEYA est le seul destinataire de vos données et s’engage à ne pas divulguer, ne pas transmettre, ni partager vos données personnelles avec d’autres entités.</small>        
                        <p class="text-danger"> <?= isset($formErrors['validate']) ? $formErrors['validate'] : '' ?> </p>                       
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <input  type="submit" class="btn btn-primary text-center" name="addDoctor" value="Enregistrer"></input>
                        <p class="formOk  text-danger"><?= isset($addDoctorMessage) ? $addDoctorMessage : '' ?></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php';
?>
        
       
        