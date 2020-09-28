<?php
$regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
$regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';
$regexpDate = '/^(19((0[4|8])|([1|3|5|7|9][2|6])|([2|4|6|8][0|4|8]))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((20((0[0|4|8])|(1[2|6])|20))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((19[0-9][0-9])|(20([0-1][0-9])|20))[ \-\/]((((0[4|6|9])|11)[ \-\/]((0[1-9])|([1|2][0-9])|30))|(((0[1|3|5|7|8])|1([0|2]))[ \-\/]((0[1-9])|([1|2][0-9])|3([0-1]))))$/';
$regexpPwd =  '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
// include ($_SERVER['PHP_SELF'] != '/index.php' ? '' : '../') . 'error.php';
include ($_SERVER['PHP_SELF'] != '/index.php' ? '../' : '') . 'controllers/headerCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="x-ua-compatible" content="ie=edge">
       <title>KENEYA</title>
       <meta charset="UTF-8">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
      <!-- Google Fonts Roboto -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      <!-- Bootstrap core CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
      <!-- Your custom styles (optional) -->
      <link rel="stylesheet" href="<?= ($_SERVER['REQUEST_URI'] == '/index.php') ? '' : '../'; ?>assets/css/style.css">
   </head>
   <body>
   <!--Navbar-->
  <nav class="navbar sticky-top fixed-top navbar-expand-lg navbar-light white text-dark scrolling-navbar">
      <!-- Navbar brand -->
      <a class="navbar-brand" href=""><img src="../assets/img/logop.png" width="80"  height="50" class="img-fluid" id="logop" alt="KENEYA logo"></a>
        <h1 class="title text-primary" >KENEYA</h1>
      <!-- Collapse button -->
      <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Accueil<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../views/espace-patients.php">  Espace Patients</a>
                </li>
                <?php
                if (isset($_SESSION['profile']['role'])){
                    if ($_SESSION['profile']['role'] == 2){?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="../views/liste-patients.php?page=1">Liste-patients</a> 
                        </li><?php
                    }
                }?>
                <li class="nav-item">
                    <a class="nav-link" href="../views/espace-praticiens.php">  Espace Praticiens</a>
                </li>
                <?php
                if (isset($_SESSION['profile']['role'])){
                    if ($_SESSION['profile']['role'] == 2){?>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="../views/liste-praticiens.php?page=1">Liste-praticiens</a> 
                        </li><?php
                    }
                }?>
                <?php 
                if(isset($_SESSION['profile']['id'] )){?> 
                    <li></li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/register.php">Inscription</a> 
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="../views/a-propos-keneya.php">A propos de KENEYA</a>
                </li>   
                <?php if(!isset($_SESSION['profile']['id'])){ //Si l'utilisateur n'est pas connecté ?>
                    <li class="nav-item ">
                            <a class="nav-link" href="<?= $_SERVER['PHP_SELF'] != 'index.php' ? '../' : '' ?>views/login.php" ><img src="../assets/img/login2.png" id="icone" alt="icone"></a>
                    </li>
                <?php } else {?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-info" href="<?= $_SERVER['PHP_SELF'] != 'index.php' ? '../' : '' ?>views/login.php"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= isset($_SESSION['profile']['mail']) ? 'Bienvenue ' . $_SESSION['profile']['mail']: ''?>
                    </a>          
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(isset($_SESSION['profile']['doctorId'])){ ?>
                            <a class="nav-link text-danger" href="<?= $_SERVER['PHP_SELF'] == '/index.php' ? 'views/' : '' ?>profil-praticien.php">Mon profil</a> 
                        <?php } else if(isset($_SESSION['profile']['patientId'])) { ?>
                        <a class="nav-link text-info" href="<?= $_SERVER['PHP_SELF'] == '/index.php' ? 'views/' : '' ?>profil-patient.php">Mon profil</a> 
                        <?php } ?>
                        <a class="nav-link text-danger" href="<?= $_SERVER['PHP_SELF'] != 'index.php' ? '../' : '' ?>index.php?action=disconnect">Déconnexion</a> 
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
            <!-- Links -->
               
       
    </nav>
    <?php
        if(isset($view)){ //Affichage de la vue sélectionnée
            include 'views/' . $view . '.php';
        }else{ ?> 
    <?php }
?>
 