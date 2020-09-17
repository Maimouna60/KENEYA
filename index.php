<?php
session_start();
$title = 'KENEYA';
$link0 = 'index.php';
include 'controllers/indexController.php';
include_once 'views/header.php'
?> 
  <div class="containeur-fluid">
      <div class="row m-0 col-12 p-0 view">
        <img class="banniere" alt="banniere" title="banniere" src="../assets/img/carte2.jpg" />
        <div class="mask rgba-blue-light">
          <p class="white-text col-6 offset-1 mt-md-5 mt-sm-1">Le Numérique au service de la santé, "KENEYA" la médecine connectée...</p>
        </div>
      </div>
  </div>    
<body>
<section class="container explanation-blocs mt-5">
<h1 class="text-center text-primary  mb-5">Nos Solutions</h1>
<div class="card-deck">
  <div class="card">
    <div class="card-body text-center">
      <img class="card-img-top" src="../assets/img/docteur dessin2.png"  class="rounded" alt="dr">
      <p class="card-text"><b>Choisissez</b> votre praticien</p>
    </div>
  </div>
  <div class="card">    
    <div class="card-body text-center">
      <img class="card-img-top" src="../assets/img/messagedessin2.png" class="rounded" alt="msg">
      <p class="card-text"><b>Prenez rdv </b> pour vous ou vos proches</p>
    </div>
  </div>
  <div class="card">   
    <div class="card-body text-center">
      <img class="card-img-top" src="../assets/img/african-apli.png" class="rounded" alt="appli">
      <p class="card-text"><b>On vous rappel</b> votre rdv la veille par SMS</p>
    </div>
  </div>
  </section>
 
    </div>
  </div>
  </section>
  <section class="container-fluid p-0" id="accueil">
    <h2 class="text-center text-primary m-5">Ce que l ' on fait pour vous?</h2>
      <div id="carouselExampleControls" class="carousel slide mx-auto" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block img-carousel mx-auto"  src="../assets/img/gynecologue.jpg." alt="first slide">
                <p class="text-center"><b>Vous avez un suivi regulier et sûr avec un professionnel à votre écoute.</b></p>
            </div>
            <div class="carousel-item">
                <img class="d-block img-carousel mx-auto" src="../assets/img/pharmacie.jpg" alt="msg" alt="Second slide">
                <p class="text-center"><b>Nous nous chargeons de vous mettre en contact avec les meilleurs instituts.</b></p>
            </div>
            <div class="carousel-item">
                <img class="d-block img-carousel mx-auto" src="../assets/img/mother2.jpg"  alt="Third slide">
                <p class="text-center"><b>Prenez soins de vos proches même à distance.</b></p>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">&laquo; Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
      
<div class="accordion md-accordion accordion-3 z-depth-1-half" style="background-color: #3e90ee; color:white;"    id="accordionEx194" role="tablist" aria-multiselectable="true">
<ul class="list-unstyled d-flex justify-content-center">
  <li><i class="fa fa-user-md mr-3 mt-2 fa-2x" aria-hidden="true"></i></li>
  <li><i class="fa fa-ambulance mr-3 mt-2 fa-2x" aria-hidden="true"></i></li>
</ul>
<h2 class="text-center h4 py-3 px-3 mb-0">Découvrer les avantages que peuvent vous apporter l'utilisation de l'application "KENEYA"</h2>
</div>
<hr class="mt-1 mb-0 ">
<!-- Accordion card -->
<div class="card">

  <!-- Card header -->
  <div class="card-header" role="tab" id="heading4">
    <a data-toggle="collapse" data-parent="#accordionEx194" href="#collapse4" aria-expanded="true"
      aria-controls="collapse4">
      <h3 class="mb-0 mt-3 h4">
        La gestion de votre agenda simplifié <img src="../assets/img/icon-agenda-plus.png" alt="icon" />
      </h3>
    </a>
  </div>

  <!-- Card body -->
  <div id="collapse4" class="collapse" role="tabpanel" aria-labelledby="heading4"
    data-parent="#accordionEx194">
    <div class="card-body pt-0">
      <h4 class="mb-0 mt-3 h5">Soyez toujours informé afin d'utiliser de facon optimale votre temps de travail grace à : </h4>
      <ul>
        <li>Rappel par SMS de vos rdvs</li>
        <li>Rappel par mail de vos rdvs</li>
        <li>Une accessibilite 24/24 et 7/7 de votre agenda</li>
      </ul>
    </div>
  </div>
</div>

  <!-- Card header -->
  

<!-- Accordion card -->
<div class="card">

  <!-- Card header -->
  <div class="card-header" role="tab" id="heading6">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx194" href="#collapse6"
      aria-expanded="false" aria-controls="collapse6">
      <h3 class="mb-0 mt-3 h4">
        Communication simplifiée avec vos patients via un carnet santé en ligne <img src="assets/img/icon comm.png" alt="icon" />
      </h3>
    </a>
  </div>

  <!-- Card body -->
  <div id="collapse6" class="collapse" role="tabpanel" aria-labelledby="heading6"
    data-parent="#accordionEx194">
    <div class="card-body pt-0">
      <h4 class="mb-0 mt-3 h5"> Les professionnelles peuvent ainsi partagee les documents importants avec leurs patients tels que :</h4>
      <ul>
        <li>Radiographies</li>
        <li>Ordonnances</li>
        <li>Compte rendu de visite</li>
        <li>Suivi de consultation </li>
        <li>Suivi de vaccination</li>
      </ul>
    </div>
  </div>
</div>
<!-- Accordion card -->
<div class="card-header" role="tab" id="heading5">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx194" href="#collapse5"
      aria-expanded="false" aria-controls="collapse5">
      <h3 class="mb-0 mt-3 h4">
        Coordination et suivi des soins entre praticiens en envoyant ou  en recevant des patients pour des besoins particuliers<img src="assets/img/icon exchange.png" alt="icon" />
      </h3>
    </a>
  </div>

  <!-- Card body -->
  <div id="collapse5" class="collapse" role="tabpanel" aria-labelledby="heading5"
    data-parent="#accordionEx194">
    <div class="card-body pt-0">
      <h4 class="mb-0 mt-3 h5">Vos patients ont besoin de voir un spécialiste ou de faire une radio ? Vous pouvez prendre directement son rendez-vous via KENEYA :</h4>
        <ul>
          <li> Accédez aux disponibilités de vos confrères, sur des créneaux qui vous sont réservez et vice versa.</li>
          <li>Vous pouvez joindre un document et un message électronique pour que votre confrère ait toutes les informations nécessaires.</li>
          <li>Votre patient reçoit la confirmation et les rappels comme s’il avait pris rendez-vous lui-même sur KENEYA.</li>
        </ul>
  
    </div>
  </div>
</div>
<hr class="mt-1 mb-0 ">
</div>
<!--/.Accordion wrapper-->
</section>
    <section class="section-container-fluid talk-about-us mt-5">
  <h2 class="title-section text-center text-primary"><strong> Ils parlent de KENEYA</strong></h2>
  <br>
  <div class="Presse text-center m-5 ">
    <a href="https://www.KENEYA.com/article-presse" title="" class="ORTM"><img src="assets/img/ortm.png" id="ORTM" alt="KENEYA logo"></a>
    <a href="https://www.KENEYA.com/article-presse" title="" class="ORTM2"><img src="assets/img/ortm2.jpg" id="ortm2" alt="KENEYA logo"></a>
    <a href="https://www.KENEYA.com/article-presse" title="" class="AFRICABLE"><img src="assets/img/africable.jpg" id="AFRICABLE" alt="KENEYA logo"></a>
    <a href="https://www.KENEYA.com/article-presse" title="" class="AFRICA N 1"><img src="assets/img/africa.jpg" id="AFRICA N 1" alt="KENEYA logo"></a>
    <a href="https://www.KENEYA.com/article-presse" title="" class="JEUNE AFRIQUE"><img src="assets/img/JeuneA.jpg" id="JEUNE AFRIQUE" alt="KENEYA logo"></a>
  </div>
</section>
<?php include 'views/footer.php';       
       