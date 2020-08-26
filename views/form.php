<?php  include 'header.php';?>

<div class="text-primary ">
 <h1 class="text-center mt-5">Connectez-vous à KENEYA </h1> 

<div id="hero_register ">
        <div class="container"> 

            <div class="row ">
                <div class=" col-6 mx-auto">
                <!-- May deleted ?? -->
                <div id="login">
                                  
                    <div class="box_form">
                        <form id="form1" action="index.php?content=Moncompte-form" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="text-center bold h5 mt-3">J'ai déjà un compte chez KENEYA</h2>
                                </div>
                            </div>

                            <div id="mailInput" class="form-group <?= count($_POST) > 0 ? (isset($formErrors['mail']) ? 'has-danger' : 'has-success') : '' ?>">
                                <label for="mail">Email :</label>
                                <input oninput="checkmail()" type="text" id="mail" name="pseudo" placeholder="Ex : Mai.kamis@gmail.com" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['mail']) ? 'value="' . $_POST['mail'] . '"' : '' ?> />
                                    <?php if (isset($formErrors['mail'])) { ?>
                                        <p class="text-danger text-center"><?= $formErrors['mail'] ?></p>
                                    <?php } ?>
                                    <p id="checkMail"></p>
                            </div>
                            <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['password']) ? 'has-danger' : 'has-success') : '' ?>">
                                <label for="password">Mot de passe :</label>
                                <input oninput="checkPassword()" type="password" id="password" name="password" placeholder="Ex : Motdepasse5*" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '' ?> />
                                    <?php if (isset($formErrors['password'])) { ?>
                                        <p class="text-danger text-center"><?= $formErrors['password'] ?></p>
                                    <?php } ?>
                                    <p id="checkPassword"></p>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group add_top_20">
                                        <button type="submit" class="btn btn-primary text-uppercase" form="form1" name="connexion" style="width: 100%">Se Connecter</button>
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
                                   <a href="ajout-praticien" class="btn btn-primary" style="width: 100%">Praticien</a>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6 dtx-6 mb-5">
                                    <a href="ajout-patient" class="btn btn-primary" style="width: 100%">Patient</a>
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