<?php 
session_start();
include_once 'header.php';
?>
<!-- header -->

    <section>
        <h1 class="text-center mt-1 mb-3 text-primary">Espace Praticiens</h1>
      <div class="containeur-fluid">
        <div class="row m-0 col-12 p-0 view">
            <img class="banniere" alt="banniere" title="banniere" src="../assets/img/docteurF.jpg" />
            <div class="mask">
                <p class="col-6 offset-1 white-text">Le Numérique au service de la santé, "KENEYA" la médecine connectée</p>
            </div>
        </div>
      </div>
      <div class="search">
          <h3 class="text-center mb-3 mt-5"><b>Un repertoire de professionnels approuvés et certifiés.</b></h>
          <div class="input-group md-form form-sm form-2 pl-0">
          <input type="text" name="searchDoctorRequest" class="form-control my-0 py-1 aqua-gradient-border ml-5" type="text" id="searchDoctorRequest" placeholder="Rechercher un praticien par specialité" size="30">
            <div class="input-group-append">
              <span type="submit" name="searchDoctor" value="rechercher" class="input-group-text aqua-gradient lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
              aria-hidden="true"></i></span> 
            </div>
          </div>
      </div>
        <div class="text-center Testimony ">
        <h2 class="font-style: italic; text-info mb-4 mt-4"><strong>Nos Praticiens témoignent!</strong></h2> 
          <!-- Container -->
      <div class="container mt-3">
      <div class="row">
        <div class=" mt-3 col-md-4 d-flex align-items-stretch">
            <div class="card">
               <img class="card-img-top" src="../assets/img/ophtalmo.jpg" id="img" alt="ophtalmo">
               <div class="card-body">
                   <h4 class="card-title"><a>Dr Mohamed KANTE</a></h4>              
                   <p class="card-text" style="font-style: italic;">"L' application KENEYA, à totalement revu nos mode de fonctionnement.
                   Elle nous aide à gerer nos agendas avec beaucoup de flexibilité et de facilité.
                   Elle me permets la creation en ligne d'un suivi de mes clients tres apprecié.
                   Je reommande vraiment KENEYA".</p>
               </div>
            </div>
        </div>   
        <div class=" mt-3 col-md-4 d-flex align-items-stretch">
          <div class="card">
             <img class="card-img-top" src="../assets/img/DENTISTE.jpg" id="img" alt="dentiste">
             <div class="card-body">
                 <h4 class="card-title"><a>Dr Anna Ba</a></h4>              
                 <p class="card-text" style="font-style: italic;">"En un mot "parfaite", 
                  cette application à totalement changée notre quotidien.
                  Elle facilite la gestion de mon agenda,
                  je peux avoir un échange de qualité avec le patient. 
                  Une vraie valeur ajoutée au bénéfice de nos patients.
                </p>
             </div>
          </div>
      </div>   
      <div class="mt-3 col-md-4 d-flex align-items-stretch">
        <div class="card">
           <img class="card-img-top" src="../assets/img/dr femme.jpg" id="img" alt="dr femme">
           <div class="card-body">
               <h4 class="card-title"><a>Dr Mariam DIAKITE</a></h4>              
               <p class="card-text" style="font-style: italic;">"C'est une application que je conseille vivement
                Elle m'aide aujourd'hui quotidiennement, notamment pour le suivi      
                de grossesse de mes patientes donc les conjoints sont à l'étranger.              
                Ils peuvent suivrent leurs consultations et compte rendu,              
                directement via l'espace, ce qui n'est pas negligeable" 
               </p>
           </div>
        </div>
      </div>   
    </div>
    </div> 
  </section>
  <div class="container"  id="#myCarousel" >
  <h1 class="text-center titreIndex"></h1>
    <div id="carouselExampleControls" class="carousel slide mx-auto mt-5 mb-4" data-ride="carousel">
        <!-- Indicators -->
      <ol class="carousel-indicators mb-0">
        <li data-target="#myCarousel" data-slide-to="0" class="active primary-color"></li>
        <li data-target="#myCarousel" data-slide-to="1" class="primary-color"></li>
        <li data-target="#myCarousel" data-slide-to="2" class="primary-color"></li>
      </ol>    
        <div class="carousel-inner">
          <div class="carousel-item active text-center">
          <div class="row ">
            <div class="img col-6 col-sm-6">
              <img class="d-block img-carousel mx-auto mb-3"  src="../assets/img/Dagenda.png." alt="first slide" classe="d-block w-80">
            </div>  
              <div class="carouselText col-12 col-sm-6 d-flex flex-wrap align-content-center">
              <p><strong>
                  Votre agenda est géré avec plus de facilité</strong></p>
              </div>
            </div>
          </div>
          <div class="carousel-item text-center">
          <div class="row">
            <div class="img col-6  col-sm-6">
              <img class="d-block img-carousel mx-auto mb-3" src="../assets/img/Dconfir.png"  alt="Second slide" classe="d-block w-80">
            </div>  
              <div class="carouselText col-12 col-sm-6 d-flex flex-wrap align-content-center">
              <p><strong>Recevez directement les demandes de rendez-vous <br>
                via votre compte professionnel</strong></p>
              </div>
              </div>
          </div>
          <div class="carousel-item text-center">
            <div class="row">
              <div class="img col-6 col-sm-6">
                <img class="d-block img-carousel mx-auto mb-3" src="../assets/img/Drdv.png"  alt="Third slide" classe="d-block w-80">
              </div>  
              <div class="carouselText col-12 col-sm-6 d-flex flex-wrap align-content-center">
                <p><strong>Ayez toujours à porter de mains le dossier medical <br>
                  et les pathologies et suivi de votre patient<strong></p>
              </div>
            </div>
          </div>           
        </div>
      </div>
</div>
<?php include 'footer.php'; ?>
 