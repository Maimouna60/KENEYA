<!-- <?php
$formErrors = array();

$regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
$regexpPwd = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
$regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';
$regexpDate = '/^(19((0[4|8])|([1|3|5|7|9][2|6])|([2|4|6|8][0|4|8]))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((20((0[0|4|8])|(1[2|6])|20))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((19[0-9][0-9])|(20([0-1][0-9])|20))[ \-\/]((((0[4|6|9])|11)[ \-\/]((0[1-9])|([1|2][0-9])|30))|(((0[1|3|5|7|8])|1([0|2]))[ \-\/]((0[1-9])|([1|2][0-9])|3([0-1]))))$/';
$regexHour = '%^(09|1([0-7])):(00|15|30|45)$%';

$user = new users(); 
$doctor = new doctor(); 

 $list = $doctor->getDoctorList();
var_dump($_POST);
//ajout d'un RDV si le formulaire est envoyer
if (isset($_POST['formAppointementSend'])) {  
    $addAppointement = new appointement(); 

    //check si appointementDate axiste dans le POST
    if (!empty($_POST['appointementDate'])) { 
        //check si appointementDate correspond a la regex
        if(preg_match($regexpDate, $_POST['appointementDate'])){
            //explose la date dans un tableau pour l'utiliser dans le checkdate
            $dateExplode = explode('-', $_POST['appointementDate']);
            //checkdate check si la date est valide
            if(!checkdate($dateExplode[1], $dateExplode[2], $dateExplode[0])){
                $formErrors['appointementDate'] = 'veuillez renseignier une date valide';
            }
        }else {
            $formErrors['appointementDate'] = 'veuillez renseignier la date au format : jj/mm/aaaa';
        }
    } else {
        $formErrors['appointementDate'] = 'Merci de choisir une date';
    }



    if(!empty($_POST['appointementTime'])){
        if (!preg_match($regexHour, $_POST['appointementTime'])){
            $formErrors['appointementTime'] = 'veuillez renseignier une heure valide';
        }
    }else {
        $formErrors['appointementTime'] = 'Merci de choisir une horaire';
    }

    //si il n'y a aucune erreur , on concatene la date et l'heure
    if (count($formErrors) == 0) {
        $addAppointement->dateHour = $_POST['appointementDate'] . ' ' . $_POST['appointementTime'];
    }




    if (!empty($_POST['doctorId'])) {    
        $doctor->id = htmlspecialchars($_POST['doctorId']);
        //check si le patient pour l'id definie au dessus existe
        if ($doctor->checkIdDoctorExist()==1){
            $addAppointement->idDoctor = $_POST['doctorId'];
        }else {
            $formErrors['doctorId'] = 'Le medecin n\'existe pas';
        }
    } else {
        $formErrors['doctorId'] = 'Merci de choisir un praticien';
    }




    if (empty($formErrors)) {
        if($addAppointement->addAppointement()){
            $addAppointementMessage = 'Le rendez-vous a bien été enregistré';
            header( "refresh:2;url=ajout-rendezvous.php" );
        }else {
            $addAppointementMessage = 'Un probleme est survenue';
        }
    }else {
        $addAppointementMessage = 'une erreur est survenue';
    }
} 


if(isset($_GET['id'])){
    $appointments = new appointments();
    $appointments->id = htmlspecialchars($_GET['id']);
    if($appointments->checkAppointmentExistById()){
        $appointmentInfo = $appointments->getAppointmentInfo();
    }else{
        $message = 'Le rendez-vous n\'existe pas';
    }
}else{
    $message = 'Une erreur s\'est produite';
}