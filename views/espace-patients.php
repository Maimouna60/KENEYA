<?php 
session_start();
include_once 'header.php'; 
?>

      <section>
      <h1 class="text-center mt-2 mb-3 text-primary">Espace Patients</h1>
      <div class="containeur-fluid">
        <div class="row m-0 col-12 p-0 view">
          <img class="banniere" alt="banniere" title="banniere" src="../assets/img/gynecol.png" />
            <div class="mask">
                <p class="text-white col-6 offset-1" >Le Numérique au service de la santé, "KENEYA" la médecine connectée</p>
            </div>
        </div>
      </div>

      <div class="text-center Testimony">
      <h2 class="font-style: italic text-info mb-4 mt-4"> Nos Patients témoignent!</h2> 
          <!-- Container -->
      <div class="container mt-3">
      <div class="row">
        <div class="mt-3 col-md-4 d-flex align-items-stretch">
            <div class="card">
               <img class="card-img-top" src="../assets/img/femmeprendrdv.jpg" id="img" alt="diariatou">
               <div class="card-body">
                   <h3 class="card-title"><a>Diariatou KEITA</a></h3>              
                   <p class="card-text" style="font-style: italic">"Je me rappelle encore de ma premiere prise de r.d.v... comme si c’était hier.
                    J’avais une douleur terrible au ventre et j’ai pu avoir un rendez-vous rapidement en ligne"
                   .</p>
               </div>
            </div>
        </div>   
        <div class="mt-3 col-md-4 d-flex align-items-stretch">
          <div class="card">
             <img class="card-img-responsive" src="../assets/img/rdvhomme.jpg" id="img" alt="rdvman">
             <div class="card-body">
                 <h3 class="card-title"><a>Sam KANTE</a></h3>              
                 <p class="card-text" style="font-style: italic;"> "Depuis que j' ai découvert l’application... je ne  m’en passe plus! 
                 Je peux prendre les rdv de ma femme et de mes enfants directement via l' application.
                 J'ai accès au suivi de leurs consultations, je suis rassuré de pouvoir suivre et prendre en charge aussi facilement, leurs bilan de santé.
                 La distance n'est plus du tout un frein pour moi."
                </p>
             </div>
          </div>
      </div>   
      <div class="mt-3 col-md-4 d-flex align-items-stretch">
        <div class="card">
           <img class="card-img-top" src="../assets/img/manphone.jpg" id="img" alt="man phone">
           <div class="card-body">
               <h3 class="card-title"><a>Ousmane SOW</a></h3>              
               <p class="card-text" style="font-style: italic;">
               "J'ai été très satisfait des possibilités offertes par cette application qui vous permet de gagner du temps 
               et de bénéficier d'une panoplie de services médicaux juste à partir de son smartphone"
               </p>
           </div>
        </div>
      </div>   
    </div>
    </div> 
  </section>
  <div class="container"  id="myCarousel">
  <h1 class="text-center titreIndex"></h1>
    <div id="carouselExampleControls" class="carousel slide mx-auto mt-5 mb-4"  data-ride="carousel">
        <!-- Indicators -->
      <ol class="carousel-indicators mb-0">
        <li data-target="#myCarousel" data-slide-to="0" class="active primary-color"></li>
        <li data-target="#myCarousel" data-slide-to="1" class="primary-color"></li>
        <li data-target="#myCarousel" data-slide-to="2" class="primary-color"></li>
      </ol>    
        <div class="carousel-inner">
          <div class="carousel-item active text-center">
          <div class="row">
            <div class="img col-12 col-sm-6">
              <img class="d-block img-carousel mx-auto mb-3"  src="../assets/img/Prdv.png" alt="first slide" classe="d-block w-80">
            </div>  
              <div class=" carouselText col-12 col-sm-6 d-flex flex-wrap align-content-center">
              <p><strong>Avec KENEYA la prise de rendez-vous rapide et facile.
              Chercher votre médecin, voir son profil, choisir votre créneau,
              et prenez rendez-vous en l'espace de quelques clics.</strong></p>
              </div>
            </div>
          </div>
          <div class="carousel-item text-center">
          <div class="row">
            <div class="img col-12 col-sm-6">
              <img class="d-block img-carousel mx-auto mb-3" src="../assets/img/Ppaiement.png"  alt="Second slide" classe="d-block w-80">
            </div>  
              <div class=" carouselText col-12 col-sm-6 d-flex flex-wrap align-content-center">
                <p><strong>Payez ou faites payer votre consultations
                 en ligne par un proche. </strong></p>
              </div>
              </div>
          </div>
          <div class="carousel-item text-center">
            <div class="row">
              <div class=" img col-12 col-sm-6">
                <img class="d-block img-carousel mx-auto mb-3" src="../assets/img/Pdossier.png"  alt="Third slide" classe="d-block w-80">
              </div>  
              <div class=" carouselText col-12 col-sm-6 d-flex flex-wrap align-content-center">
                <p><strong>Vous avez acces a l'ensemble de vos compte rendu de consultations,
               par le biais de votre carnet de santé electroniques.</strong></p>
              </div>
            </div>
          </div>           
        </div>
        <!--<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon primary-color no-padding" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
          <span class="carousel-control-next-icon primary-color" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>-->
      </div>
</div>
 
<?php include 'footer.php'; ?>
      
   
