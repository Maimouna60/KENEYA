<?php 
$user = new users();
$patient = new patients();

$formErrors = array();
$regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
$regexpPwd = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
$regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';
$regexpDate = '/^(19((0[4|8])|([1|3|5|7|9][2|6])|([2|4|6|8][0|4|8]))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((20((0[0|4|8])|(1[2|6])|20))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((19[0-9][0-9])|(20([0-1][0-9])|20))[ \-\/]((((0[4|6|9])|11)[ \-\/]((0[1-9])|([1|2][0-9])|30))|(((0[1|3|5|7|8])|1([0|2]))[ \-\/]((0[1-9])|([1|2][0-9])|3([0-1]))))$/';
    //$appointement = new appointement();

    // $pageNumber = 


    // fonction pour delete un user et ses rendezvous
    if (isset($_POST['id'])){
        $patient->id = $_POST['id'];
        if ($patient->checkIdPatientExist() == 1) {
            $user->deleteUserById();
        }
    }
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else {
        $page = 1;
    }
    $limitArray = ['limit'=>5];
    $limitArray['offset'] = ($page * $limitArray['limit']) - $limitArray['limit'];
    //affiche le resultat de la recherche si le champs de recherche est activer , sinon toute la liste avec la pagination
    if(isset($_POST['searchPatient'])) {
        if (!empty($_POST['searchPatientRequest'])){
            $search['lastname'] = htmlspecialchars($_POST['searchPatientRequest']) . '%';
            // $search['firstname'] = htmlspecialchars($_POST['searchPatientRequest']) . '%';
        }
        if (!empty($_POST['searchbydate']) && preg_match($regexpDate, $_POST['searchbydate'])){
            $search['birthdate'] = htmlspecialchars($_POST['searchbydate']);
        }
        $list = $patient->getPatientListLimited($limitArray,$search);
        $pageNumber = ceil(count($patient->getPatientListLimited(array(),$search)) / $limitArray['limit']);
    }else {
        $list = $patient->getPatientListLimited($limitArray);
        $pageNumber = ceil(count($patient->getPatientListLimited()) / $limitArray['limit']);
    }
    



