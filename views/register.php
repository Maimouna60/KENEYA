<?php  
session_start();
include_once '../models/users.php';
include_once '../models/database.php';
include_once '../controllers/loginOnlyCtrl.php';
include_once 'header.php';
?>

<div class="text-primary ">
 <h1 class="text-center mt-5 mb-5">Nouveau sur KENEYA ?</h1> 

<div id="hero_register ">
        <div class="container"> 

            <div class="row ">
                <div class=" col-6 mx-auto">
                <!-- May deleted ?? -->
                <div id="register">
                                  
                    <div class="box_form">
                        <form id="form1" action="register.php" method="POST">


                            <div class="row">
                                <div class="col-12">
                                    <h2 class="text-center bold mt-2 mb-5">Inscrivez-vous :</h2>
                                </div>
                            </div>

                            <div class="row text-uppercase mt-4 mb-5">
                                <div class="col-12 col-md-6 col-xl-6 tx-6">
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