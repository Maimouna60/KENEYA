<?php
$regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
$regexpPhone = '/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/';
$regexpDate = '/^(19((0[4|8])|([1|3|5|7|9][2|6])|([2|4|6|8][0|4|8]))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((20((0[0|4|8])|(1[2|6])|20))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((19[0-9][0-9])|(20([0-1][0-9])|20))[ \-\/]((((0[4|6|9])|11)[ \-\/]((0[1-9])|([1|2][0-9])|30))|(((0[1|3|5|7|8])|1([0|2]))[ \-\/]((0[1-9])|([1|2][0-9])|3([0-1]))))$/';
$regexpPwd =  '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';

/**$pageList = array('Accueil' => 'Accueil'
                ,'Espace-patients' =>'Espace Patients'
                ,'Espace-praticiens' =>'Espace Praticiens'
                ,'A-propos-KENEYA' => 'A propos de KENEYA'
                ,'Moncompte-form' => 'Compte client');*/
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
              <li class="nav-item active">
                  <a class="nav-link" href="../index.php">Accueil<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown">  
                  <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false" href="../views/espace-patients.php">Espace Patients</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                       <a class="dropdown-item" href="">Connexion</a>
                       <a class="dropdown-item" href="">Déconnexion</a>
                       <a class="dropdown-item" href="#">Inscription</a>
                    </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false" href="../views/espace-patients.php">Espace Praticiens</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                       <a class="dropdown-item" href="">Connexion</a>
                       <a class="dropdown-item" href="">Déconnexion</a>
                       <a class="dropdown-item" href="#">Inscription</a>
                    </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="../views/a-propos-keneya.php">A propos de KENEYA</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="../views/form.php"><img src="../assets/img/login.png" id="icone" alt="icone"></a>
              </li>

              <!-- Dropdown
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false" href="views/form.php"><img src="../assets/img/login.png" id="icone" alt="icone"></a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="views/moncompte-form.php">Connexion</a>
                      <a class="dropdown-item" href="#">Inscription</a>
                  </div>
              </li> -->
          </ul>
          <!-- Links -->
      </div>
      <!-- Collapsible content -->
   </nav>
   <!--/.Navbar-->
   
 