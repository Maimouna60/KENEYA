<?php
if(isset($_GET['id'])){
    $patient = new patients();
    $patient->id = $_GET['id'];
    if($patient->getProfilPatient()){
        $patientInfo = $patient->getProfilPatient();
    }else {
        $message = 'Ce patient n\'éxiste pas';
    }
}
$message = 'une erreur est survenue';
