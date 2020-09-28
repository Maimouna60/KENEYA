<?php 
$user = new users();
$doctor = new doctor();

$formErrors = array();
$regexpName = '/^[a-zA-ZÀ-ÖØ-öø-ÿ\'\ \-\_]+$/';
$regexpPwd = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
$regexpPhone = '/^(((00)|\+) 223)( [0-9]{2}){4}$/';
$regexpDate = '/^(19((0[4|8])|([1|3|5|7|9][2|6])|([2|4|6|8][0|4|8]))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((20((0[0|4|8])|(1[2|6])|20))[ \-\/]02[ \-\/]((0[1-9])|([1|2][0-9])))|((19[0-9][0-9])|(20([0-1][0-9])|20))[ \-\/]((((0[4|6|9])|11)[ \-\/]((0[1-9])|([1|2][0-9])|30))|(((0[1|3|5|7|8])|1([0|2]))[ \-\/]((0[1-9])|([1|2][0-9])|3([0-1]))))$/';
    //$appointement = new appointement();

    // $pageNumber = 

   
    // fonction pour delete un user 
    if (isset($_POST['deleteUser'])){
        $user->id = $_POST['deleteUser'];
        // if ($doctor->checkIdDoctorExist() == 1) {

            $user->deleteUserById();
        // }
    }
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else {
        $page = 1;
    }
    $limitArray = ['limit'=>5];
    $limitArray['offset'] = ($page * $limitArray['limit']) - $limitArray['limit'];
    //affiche le resultat de la recherche si le champs de recherche est activer , sinon toute la liste avec la pagination
    if(isset($_POST['searchDoctor'])) {
        if (!empty($_POST['searchDoctorRequest'])){
            $search['lastname'] = htmlspecialchars($_POST['searchDoctorRequest']) . '%';
            // $search['firstname'] = htmlspecialchars($_POST['searchDoctorRequest']) . '%';
        }
         if (!empty($_POST['searchbyMail']) && $_POST['searchbyMail']){
             $search['mail'] = $_POST['searchbyMail'] . '%';
         }
    }

    if(!empty($search)){
        $list = $doctor->getDoctorListLimited($limitArray,$search);
        $pageNumber = ceil(count($doctor->getDoctorListLimited(array(),$search)) / $limitArray['limit']);
    }else {
        $list = $doctor->getDoctorListLimited($limitArray);
        $pageNumber = ceil(count($doctor->getDoctorListLimited()) / $limitArray['limit']);
    
    }



