<?php

class users {
    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $mail = '';
    public $password = '';
    public $id_dom20_roles = 0;
    private $table = '`dom20_users`';
    private $db = NULL;
    public function __construct()
    {
        $this->db = dataBase::getInstance();
    }
    //methode issue de l'objet PDO de la classe dataBase et qui sont static
    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }
    public function rollBack()
    {
        return $this->db->rollBack();
    }
    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }
    public function commit()
    {
        return $this->db->commit();
    }

/**********************************connexion*******************************/
/*
 * Méthode permettant de se connecter
 */
    public function connectUser(){
        $addUser = $this->db->prepare('
            INSERT INTO ' . $this->table . '
            ( `mail`, `password`)
            VALUES ( :mail, :password)
        ');
        $addUser->bindValue(':mail',$this->mail,PDO::PARAM_STR);
        $addUser->bindValue(':password',$this->password,PDO::PARAM_STR);
        return $addUser->execute();
    }

   

    /**
     * Méthode permettant de récupérer le hash du mot de passe de l'utilisateur
     *
     * @return void
     */
    public function getUserPasswordHash(){
        $getUserPasswordHash = $this->db->prepare(
            'SELECT `password` 
            FROM ' . $this->table 
            . ' WHERE `mail` = :mail'
        );
        $getUserPasswordHash->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $getUserPasswordHash->execute();
        $response = $getUserPasswordHash->fetch(PDO::FETCH_OBJ);
        if(is_object($response)){
            return $response->password;
        }else{
            return '';
        }
    }

/************************************************************************Ajouter un utilisateur********************************************************/
    /**
     * Méthode permettant d'enregistrer un utilisateur
     * /**requete qui me permettra d'ajouter les infos dans ma table user 
     * @return boolean
     */
    public function addUser()
    {
        $addUser = $this->db->prepare(
            'INSERT INTO `dom20_users` (`lastname`,`firstname`,`mail`,`password`,`id_dom20_roles`) 
            VALUES(:lastname, :firstname, :mail, :password, 3)'/***les marqueur nominatif me permettrons une securisation pdo */
        );
        //je prepare ma requete
        $addUser->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addUser->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $addUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $addUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        return $addUser->execute();
    }
 /**************************************************************************Ajouter un admin******************************************
     * Méthode permettant d'enregistrer un utilisateur
     * /**requete qui me permettra d'ajouter les infos dans ma table user 
     * @return boolean
     */
    public function addAdmin()
    {
        $addUser = $this->db->prepare(
            'INSERT INTO `dom20_users` (`lastname`,`firstname`,`mail`,`password`,`id_dom20_roles`) 
            VALUES(:lastname, :firstname, :mail, :password, 2)'/***les marqueur nominatif me permettrons une securisation pdo */
        );
        //je prepare ma requete
        $addUser->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addUser->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $addUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $addUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        return $addUser->execute();
    }



    /**
     * Méthode permettant de savoir une valeur d'un champ est déjà prise    
     * Valeur de retour :
     *  - True : la valeur est déjà prise
     *  - False : la valeur est disponible
     * @param array $field
     * @return boolean
     */
    public function checkUserUnavailabilityByFieldName($field){
        $checkUserUnavailabilityByFieldName = $this->db->prepare(
            'SELECT COUNT(`id`) as `isUnavailable`
            FROM ' . $this->table . 
        ' WHERE `' .$field . '` = :' . $field
        );
        if($field == 'id'){
            $checkUserUnavailabilityByFieldName->bindValue(':id', $this->id, PDO::PARAM_INT);
        }else {
            $checkUserUnavailabilityByFieldName->bindValue(':' . $field, $this->$field, PDO::PARAM_STR);
        }
        $checkUserUnavailabilityByFieldName->execute();
        return $checkUserUnavailabilityByFieldName->fetch(PDO::FETCH_OBJ)->isUnavailable;
    }

    
    /**
     * Méthode permettant de récupérer les différentes infos d'un utilisateur pour ajouter et connecter
     * 
     * @return object
     */
    public function getUserProfile()
    {
        $getUserProfile = $this->db->prepare(
            'SELECT `id`, `mail`
            FROM  `dom20_users`
            WHERE `mail` = :mail'
        );
        $getUserProfile->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $getUserProfile->execute();
        return $getUserProfile->fetch(PDO::FETCH_OBJ);
    }

    public function checkMailUserExist()
    {
        //check si l'id du patient existe, retourne 1 si oui, 0 sinon
        $checkMailPatientExist = $this->db->prepare(
            'SELECT 
                COUNT(id) AS isIdPatientExist
            FROM `dom20_users`
            WHERE `mail` = :mail
        '
        );
        $checkMailPatientExist->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $checkMailPatientExist->execute();
        $data = $checkMailPatientExist->fetch(PDO::FETCH_OBJ);
        return $data->isIdPatientExist;
    }
    
    public function checkMailUserDoctorExist()
    {
        //chek si l'id du patient existe, retourne 1 si oui, 0 sinon
        $checkMailDoctorExist = $this->db->prepare(
            'SELECT 
                COUNT(id) AS isIdDoctorExist
            FROM `dom20_users`
            WHERE `mail` = :mail
        '
        );
        $checkMailDoctorExist->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $checkMailDoctorExist->execute();
        $data = $checkMailDoctorExist->fetch(PDO::FETCH_OBJ);
        return $data->isIdDoctorExist;
    }
 /************************************************************************afficher le profil patient ************************************************/
    public function getUserDetails() {
        $usersDetails = $this->db->prepare(
           'SELECT 
                `us`.`lastname`
               ,`us`.`firstname`
               ,DATE_FORMAT(`pat`.`birthDate`, \'%d/%m/%Y\') AS `birthDateFr` 
               ,`pat`.`birthDate`
               ,`pat`.`phoneNumbers`
               ,`us`.`mail`
           FROM 
               `dom20_users`  as `us`
           INNER JOIN  
                `dom20_patients` AS  `pat`
           ON `us`.`id` = `pat`.`id_dom20_users`
           WHERE
               `us`.`id` = :id        
           ');
       $usersDetails->bindValue(':id', $this->id, PDO::PARAM_INT);
       $usersDetails->execute();
       return $usersDetails->fetch(PDO::FETCH_OBJ);
       
       } 
  /**************************************************************************afficher le profil docteur ***********************************************************/
    public function getUserDocDetails() {
        $usersDocDetails = $this->db->prepare(
           'SELECT 
                `us`.`lastname`
               ,`us`.`firstname`
               ,`us`.`mail`
               ,`doc`.`phoneNumbers`
               ,`doc`.`price`
               ,`spe`.`name`
               ,`pla`.`placename`
               , `doc`.`id_dom20_practiceplace`
               , `doc`.`id_dom20_specialities`
            FROM 
                `dom20_users`  as `us`
            INNER JOIN  
                `dom20_doctors` AS  `doc`
            ON 
                `us`.`id` = `doc`.`id_dom20_users` 
            INNER JOIN 
                `dom20_specialities` AS `spe` 
            ON  
                `spe`.`id` = `doc`.`id_dom20_specialities`
            INNER JOIN
                `dom20_practiceplace` AS `pla`
            ON  `pla`.`id` = `doc`. `id_dom20_practiceplace`
            WHERE
                `us`.`id` = :id
            ');
       $usersDocDetails->bindValue(':id', $this->id, PDO::PARAM_INT);
       $usersDocDetails->execute();
       return $usersDocDetails->fetch(PDO::FETCH_OBJ);    
    }   

/**********************************************************************************Modification du profil patient***********************************************/
public function modifyUsers() {
    //update la table patient(){
        $modifyUsersQuery = $this->db->prepare(
            'UPDATE
                `dom20_users`
            SET 
                lastname = :lastname
                ,firstname = :firstname
                ,mail = :mail
            WHERE id= :id 
            ');
        // On choisi les colonnes que l'on souhaite modifier avec SET, on leur attribue un marqueur nominatif ':  ' 
        // avec un bindValue on donne des valeurs à nos marqueurs nominatifs puis on execute();
        $modifyUsersQuery->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $modifyUsersQuery->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $modifyUsersQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $modifyUsersQuery->bindValue(':id', $this->id, PDO::PARAM_STR);
            return $modifyUsersQuery->execute();  
    }
/************************************************************************************Modification du profil docteur***********************************************************/
public function modifyUsersDoctor() {
        $modifyUsersQuery = $this->db->prepare(
            'UPDATE
                `dom20_users`
            SET 
                lastname = :lastname
                ,firstname = :firstname
                ,mail = :mail
            WHERE id= :id 
            ');
        // On choisi les colonnes que l'on souhaite modifier avec SET, on leur attribue un marqueur nominatif ':  ' 
        // avec un bindValue on donne des valeurs à nos marqueurs nominatifs puis on execute();
        $modifyUsersQuery->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $modifyUsersQuery->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $modifyUsersQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $modifyUsersQuery->bindValue(':id', $this->id, PDO::PARAM_STR);
            return $modifyUsersQuery->execute();  
    }
/**************************************************************************************Delete Users******************************************************************* */
    public function deleteUserById(){
        $deleteUserByIdQuery = $this->db->prepare(
            'DELETE FROM
                `dom20_users`
            WHERE 
                id = :id
            ');
            $deleteUserByIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $deleteUserByIdQuery->execute();
    }

    
    function getPatientList() {
        $getPatientList = $this->db->query(
            //reformate la date sur le format francais
            'SELECT 
                `us`.`lastname`
                ,`us`.`firstname`
                ,DATE_FORMAT(`pat`.`birthDate`, \'%d/%m/%Y\') AS `birthDateFr` 
                ,`pat`.`birthDate`
                ,`pat`.`phoneNumbers`
                ,`us`.`mail`
            FROM 
                `dom20_users`  as `us`
            INNER JOIN  
                    `dom20_patients` AS  `pat`
            ON `us`.`id` = `pat`.`id_dom20_users`
            WHERE
                `us`.`id` = :id        
            ORDER BY `lastname` ASC
        ');
        // fetchAll permet de recuperer un tableau d'objet
        return $getPatientList->fetchAll(PDO::FETCH_OBJ);
}

}
