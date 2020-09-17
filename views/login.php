<?php  
session_start();
include_once '../models/database.php';
include_once '../models/users.php';
include_once '../models/patients.php';
include_once '../models/praticiens.php';
include_once '../controllers/loginCtrl.php';
include_once 'header.php';
?>

<div class="text-primary ">
 <h1 class="text-center mt-5">Connectez-vous à KENEYA </h1> 

<div id="hero_register ">
        <div class="container"> 

            <div class="row ">
                <div class=" col-6 mx-auto">
                <!-- May deleted ?? -->
                <div id="loginOnly">
                                  
                    <div class="box_form">
                        <form id="form1" action="login.php" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="text-center bold h5 mt-3">J'ai déjà un compte chez KENEYA</h2>
                                </div>
                            </div>

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
                                        <button type="submit" class="btn btn-primary text-uppercase" form="form1" name="login" style="width: 100%">Se Connecter</button>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                                <div class="col-12 text-uppercase text-center">
                                    <a href="">
                                        <small>Mot de passe oublié ?</small>
                                    </a>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <h2 class="text-center bold h5">Nouveau sur KENEYA?</h2>
                                    <p class="text-uppercase text-center">
                                        Inscrivez-vous : 
                                    </p>
                                </div>
                            </div>

                            <div class="row text-uppercase">
                                <div class="col-12 col-md-6 col-xl-6  dtx-6">
                                   <a href="ajout-praticien.php" class="btn btn-primary" style="width: 100%">Praticien</a>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6 dtx-6 mb-5">
                                    <a href="ajout-patient.php" class="btn btn-primary" style="width: 100%">Patient</a>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
                <!-- /login -->
            </div>
        </div>

    </div> 

   
<?php  include 'footer.php';?>