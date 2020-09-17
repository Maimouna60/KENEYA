<?php  
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/patients.php';
include_once '../models/praticiens.php';
include_once '../controllers/loginOnlyCtrl.php';
include_once 'header.php';
?>
<div class="text-primary ">
 <h1 class="text-center mt-5">Bonjour</h1> 

<div id="hero_register ">
        <div class="container"> 

            <div class="row ">
                <div class=" col-6 mx-auto">
                <!-- May deleted ?? -->
                <div id="loginOnly">
                                  
                    <div class="box_form">
                        <form id="form1" action="loginOnly.php" method="POST">
                            
                            <div id="mailInput" class="form-group <?= count($_POST) > 0 ? (isset($formErrors['mail']) ? 'has-danger' : 'has-success') : '' ?>">
                                <label for="mail">Adresse mail :</label>
                                    <input type="email" class="form-control" id="mail" aria-describedby="mailHelp" name="mail"/>
                                    <?php if(isset($formErrors['mail'])){ ?>
                                        <p class="text-danger"><?= $formErrors['mail'] ?></p>
                                <?php }else{ ?>
                                        <small id="mailHelp" class="form-text text-muted">Merci de renseigner votre adresse mail</small>
                                <?php } ?>
                            </div>
                            <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['password']) ? 'has-danger' : 'has-success') : '' ?>">
                                <label for="password">Mot de passe :</label>
                                <input type="password" class="form-control" id="password" aria-describedby="passwordHelp" name="password" />
                                <?php if(isset($formErrors['password'])){ ?>
                                    <p class="text-danger"><?= $formErrors['password'] ?></p>
                                <?php }else{ ?>
                                    <small id="passwordHelp" class="form-text text-muted">Merci de renseigner votre mot de passe</small>
                                    <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group add_top_20">
                                        <button type="submit" class="btn btn-primary text-uppercase" form="form1" name="loginOnly" style="width: 100%">Se Connecter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
                   
