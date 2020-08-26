<?php
include 'header.php';
include '../models/database.php';
include_once '../models/praticiens.php';
include '../controllers/ajout-praticiensController.php'; 
?>
<div class="container-fluid primary"> 
    <div class="row ">
        <div class="col-6 mx-auto">
            <form id="ajout-praticien" action="ajout-praticien.php" method="POST">
                <div class="row">
                    <div class="col-12">   
                        <div class="form-group">
                            <label for="lastname">Nom :</label>
                            <input id="lastname" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['lastname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" type="text" name="lastname" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['lastname']) ? $formErrors['lastname'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Prénom :</label>
                            <input id="firstname" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['firstname']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" type="text" name="firstname" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['firstname']) ? $formErrors['firstname'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Date de naissance :</label>
                            <input id="birthdate" type="date" name="birthdate" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['birthdate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : '' ?>" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['birthdate']) ? $formErrors['birthdate'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumbers">Numéros de téléphone :</label>
                            <input id="phoneNumbers"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['phoneNumbers']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['phoneNumbers']) ? $_POST['phoneNumbers'] : '' ?>" type="tel" name="phoneNumbers" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['phoneNumbers']) ? $formErrors['phoneNumbers'] : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="matricule">Numéro d'inscription à l'ordre des médecins :</label>
                            <input id="matricule"  class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['matricule']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['matricule']) ? $_POST['matricule'] : '' ?>" type="text" name="matricule" />
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['matricule']) ? $formErrors['matricule'] : '' ?></p>
                        </div>
                    </div>
                </div>
                        <div class="row text-uppercase">
                        <div class="col-12 col-md-6 col-xl-6">
                             <select class="form-control custom-select" placeholder="pratiquePlace" name="clinique" required="">
                            <option value="">Clinique</option>
                                <option value="1">Médical Grace</option>
                                <option value="2">Union</option>
                                <option value="3">Ophtalmo Plus</option>
                                <option value="4">Espérance de Vie</option>
                                <option value="5">Médicale Youma</option>
                                <option value="6">Médicale MAM</option>
                                <option value="7">Médicale le Relais Yalaly</option>
                                <option value="8">Médicale Mozart</option>
                                <option value="9">Sianwa</option>
                                <option value="10">Mohamed 5</option>
                                <option value="11">Ophtalmologie Lafia</option>
                                <option value="12">Doumare Ameri</option>
                                <option value="13">Médical Kala Diata</option>
                                <option value="14">Etoiles</option>
                                <option value="15">Keneya</option>
                                <option value="16">Médicale Sankoré</option>
                                <option value="17">Thiam</option>
                                <option value="18">Cabient Médicale Docteur Yamadou Sidibé</option>
                                <option value="19">La Paix Divine</option>
                                <option value="20">Polyclinique ALMED</option>
                                <option value="22">El Shaddaï</option>
                                <option value="23">MedicPlus</option>
                                <option value="24">Diata</option>
                                <option value="25">2M</option>
                                <option value="26">Cabinet Dentaire Dr Safiatou Coulibaly</option>
                                <option value="27">Youma</option>
                                <option value="28">Avicenne</option>
                                <option value="29">Le Kaarta</option>
                                <option value="30">Eden</option>
                                <option value="31">Espoir Naata</option>
                                <option value="32">CNAM</option>
                                <option value="33">GAHAMBANI</option>
                                <option value="34">Centre Médical BIA</option>
                                <option value="35">Centre Médical Salam</option>
                                <option value="36">ASMA</option>
                                <option value="37">Médicale Nouveau Soleil</option>
                                <option value="38">Solidarité</option>
                                <option value="39">Pont d'Ain</option>
                                <option value="40">Initiale Santé</option>
                                <option value="41">Cabinet Médical Fakoly</option>
                                <option value="42">A Domicile</option>
                                <option value="43">Le Soudan</option>
                                <option value="44">Cabinet médical Sabunyuman</option>
                                <option value="45">Défi Santé</option>
                                <option value="46">Cabinet Yereko</option>
                                <option value="47">Cabinet Dentaire du Golf</option>
                                <option value="48">Blanco Dent</option>
                                <option value="49">Cabinet Médical du Centre</option>
                                <option value="50">Cabinet Doniya</option>
                                <option value="51">Cabinet Kafo</option>
                                <option value="52">Horizon Santé</option>
                                <option value="53">Donko</option>
                                <option value="54">Cabinet Médical Solidarité</option>
                                <option value="55">Cabinet Médical Duflo</option>
                                <option value="56">Centre médical du palais</option>
                                <option value="57">Clinique Farako</option>
                                <option value="58">PSY2A</option>
                                <option value="59">Clinique d'ophtamologue El Azar</option>
                                <option value="60">Centre de Santé de la Croix du Sud</option>
                                <option value="61">Csref</option>
                                <option value="62">Cabinet Médical la Reference</option>
                                <option value="65">Polyclinique Pasteur</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <select class="form-control custom-select" placeholder="spéciality" name="spécialité" required="">
                        <option value="">Spécialité</option>  
                        </select>
                    </div>
                    </div>
                    <div class="row text-uppercase">
                    <div class="col-12 col-md-6 col-xl-6">
                        <label for="email">Adresse e-mail :</label>
                        <input type="email" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($formErrors['email']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="email" name="email" value="<?= (!empty($_POST['email'])) ? $_POST['email'] : '' ; ?>" />
                        <p class="text-danger"><?= (!empty($formErrors['email'])) ? $formErrors['email'] : '' ;?></p>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                    <label for="emailConfirm">Confirmer adresse e-mail :</label>
                    <input type="email" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($formErrors['emailConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="emailConfirm" name="emailConfirm" />
                    <p class="text-danger"><?= (!empty($formErrors['emailConfirm'])) ? $formErrors['emailConfirm'] : '' ;?></p>
                    </div>
                </div>
                    <!--MOT DE PASSE -->
                    <div class="row text-uppercase">
                    <div class="col-12 col-md-6 col-xl-6"> 
                        <label for="password">Mot de passe :</label>
                        <input type="password" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($formErrors['password']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="password" name="password" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ; ?>" />
                        <p class="text-danger"><?= (!empty($formErrors['password'])) ? $formErrors['password'] : '' ;?></p>
                    </div>
                    <div class="form-group col-12">
                        <label for="passwordConfirm">Confirmer mot de passe :</label>
                        <input type="password" class="form-control <?=(isset($_POST['postSubscribe'])) ? (!empty($formErrors['passwordConfirm']))? 'is-invalid' : 'is-valid'  : '' ; ?>" id="passwordConfirm" name="passwordConfirm" />
                        <p class="text-danger"><?= (!empty($formErrors['passwordConfirm'])) ? $formErrors['passwordConfirm'] : '' ;?></p>
                    </div>
                    </div>
                </div>
                <div class="row text-uppercase">
                    <div class="col-12 col-md-6 col-xl-6"><input type="checkbox" name="validate" id="validate" />
                        <label for="validate">J'accepte les <a href="cgu">CGU.</a></label>
                        <small>KENEYA est le seul destinataire de vos données et s’engage à ne pas divulguer, ne pas transmettre, ni partager vos données personnelles avec d’autres entités.        
                        <p class="text-danger"> <?= isset($formErrors['validate']) ? $formErrors['validate'] : '' ?> </p>                       
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                        <input  type="submit" class="btn btn-primary text-center" name="addPatient" value="Enregistrer"></input>
                        <p class="formOk"><?= isset($addPatientMessage) ? $addPatientMessage : '' ?></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php';
        
       
        