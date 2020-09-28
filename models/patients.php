<?php

class patients
{
    public $id = 0;
    public $birthDate = 0000 - 00 - 00;
    public $phoneNumbers = '';
    public $id_dom20_users = 0;
    private $table = '`dom20_patients`';
    public $db = NULL;
    public function __construct()
    {
        $this->db = dataBase::getInstance();
    }


    /**
     * Méthode permettant de savoir une valeur d'un champ est déjà prise    
     * Valeur de retour :
     *  - True : la valeur est déjà prise
     *  - False : la valeur est disponible
     * @param array $field
     * @return boolean
     */
    public function checkUserUnavailabilityByFieldName($field)
    {
        $checkUserUnavailabilityByFieldName = $this->db->prepare(
            'SELECT COUNT(`id`) as `isUnavailable`
            FROM ' . $this->table .
                ' WHERE `' . $field . '` = :' . $field
        );
        if ($field == 'id') {
            $checkUserUnavailabilityByFieldName->bindValue(':id', $this->id, PDO::PARAM_INT);
        } else if ($field == 'id_dom20_users') {
            $checkUserUnavailabilityByFieldName->bindValue(':id_dom20_users', $this->id_dom20_users, PDO::PARAM_INT);
        } else {
            $checkUserUnavailabilityByFieldName->bindValue(':' . $field, $this->$field, PDO::PARAM_STR);
        }
        $checkUserUnavailabilityByFieldName->execute();
        return $checkUserUnavailabilityByFieldName->fetch(PDO::FETCH_OBJ)->isUnavailable;
    }

    /*****************Creation du patient ***********************************/
    public function addPatient()
    {
        //$db devient une instance de l'objet PDO
        // on fait une requête préparée
        $addPatient = $this->db->prepare(
            // Marqueur nominatif
            //bindValue: vérifie le type et que ça ne génère pas de faille de sécurité.
            //$this-> : permet d'acceder aux attributs de l'instance qui est en cours
            'INSERT INTO `dom20_patients` (`birthDate`,`phoneNumbers`,id_dom20_users)
          VALUES (:birthDate, :phoneNumbers, :id_dom20_users)'
        );
        // :lastname est un marqueur nominatif
        $addPatient->bindvalue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $addPatient->bindvalue(':phoneNumbers', $this->phoneNumbers, PDO::PARAM_STR);
        $addPatient->bindvalue(':id_dom20_users', $this->id_dom20_users, PDO::PARAM_INT);
        return $addPatient->execute();
    }
    /******************verifier l existance du patient ****************/
    public function checkIdPatientExist()
    {
        //check si l'id du patient existe, retourne 1 si oui, 0 sinon
        $checkIdPatientExistQuery = $this->db->prepare(
            'SELECT 
                COUNT(id) AS isIdPatientExist
            FROM `dom20_patients`
            WHERE id = :id
        '
        );
        $checkIdPatientExistQuery->bindvalue(':id', $this->id, PDO::PARAM_INT);
        $checkIdPatientExistQuery->execute();
        $data = $checkIdPatientExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isIdPatientExist;
    }

    /**************************Modifier le patient***************************/
    public function modifyPatient()
    {
        $modifyPatientQuery = $this->db->prepare(
            'UPDATE
                `dom20_patients`
            SET 
                birthDate = :birthDate
                ,phoneNumbers = :phoneNumbers
            WHERE `id_dom20_users`= :id_dom20_users
        '
        );
        // On choisi les colonnes que l'on souhaite modifier avec SET, on leur attribue un marqueur nominatif ':  ' 
        // Avec un bindValue on donne des valeurs à nos marqueurs nominatifs puis on execute();
        $modifyPatientQuery->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $modifyPatientQuery->bindValue(':phoneNumbers', $this->phoneNumbers, PDO::PARAM_STR);
        $modifyPatientQuery->bindValue(':id_dom20_users', $this->id_dom20_users, PDO::PARAM_INT);
        return  $modifyPatientQuery->execute();
    }

    /*********************************Recuperation Id Patient************************************/
    public function getPatientIdByUserId()
    {
        $getUserIdQuery = $this->db->prepare(
            'SELECT `id`
            FROM  `dom20_patients`
            WHERE `id_dom20_users` =:id_dom20_users
        '
        );
        $getUserIdQuery->bindValue('id_dom20_users', $this->id_dom20_users, PDO::PARAM_INT);
        $getUserIdQuery->execute();
        return $getUserIdQuery->fetch(PDO::FETCH_OBJ);
    }

    public function getUserIdById()
    {
        $getUserIdQuery = $this->db->prepare(
            'SELECT `id_dom20_users`
            FROM  `dom20_patients`
            WHERE `id` = :id
        '
        );
        $getUserIdQuery->bindValue('id', $this->id, PDO::PARAM_INT);
        $getUserIdQuery->execute();
        return $getUserIdQuery->fetch(PDO::FETCH_OBJ);
    }

    /********************************************Recuperation liste de patient******************************* */

    function getPatientList()
    {
        $getPatientList = $this->db->query(
            //reformate la date sur le format francais
            'SELECT 
                    `us`.`id`
                    ,`us`.`lastname`
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
            '
        );
        // fetchAll permet de recuperer un tableau d'objet
        return $getPatientList->fetchAll(PDO::FETCH_OBJ);
    }


    function getPatientListLimited($limitArray = array(), $searchArray = array())
    {
        if (count($searchArray) > 0) {
            $where = 'WHERE ';
            foreach ($searchArray as $fieldName => $search) {
                // strrchr — Trouve la dernière occurrence d'un caractère dans une chaîne
                if (strrchr($search, '%')) {
                    $whereArray[] = '`' . $fieldName . '` LIKE :' . $fieldName;
                } else {
                    $whereArray[] = '`' . $fieldName . '` = :' . $fieldName;
                }
            }
            // implode — Rassemble les éléments d'un tableau en une chaîne
            $where .= implode(' AND ', $whereArray);
        }
        $getPatientListLimited = $this->db->prepare(
            'SELECT 
                `pat`.`id`
                    ,`us`.`id` AS `usid`
                    ,`us`.`lastname`
                    ,`us`.`firstname`
                    ,DATE_FORMAT(`pat`.`birthDate`, \'%d/%m/%Y\') AS `birthDateFr` 
                    ,`pat`.`birthDate`
                    ,`pat`.`phoneNumbers`
                    ,`us`.`mail`
                FROM 
                    `dom20_users`  AS `us`
                INNER JOIN  
                        `dom20_patients` AS  `pat`
                ON `us`.`id` = `pat`.`id_dom20_users`
                ' . (isset($where) ? $where : '') . '             
                ORDER BY `lastname` ASC '
                . (count($limitArray) == 2 ? 'LIMIT :limit OFFSET :offset' : '')
        );
        foreach ($searchArray as $fieldName => $search) {
            $getPatientListLimited->bindvalue(':' . $fieldName, $search, PDO::PARAM_STR);
        }
        if (count($limitArray) == 2) {
            $getPatientListLimited->bindvalue(':limit', $limitArray['limit'], PDO::PARAM_INT);
            $getPatientListLimited->bindvalue(':offset', $limitArray['offset'], PDO::PARAM_INT);
        }
        $getPatientListLimited->execute();
        return $getPatientListLimited->fetchAll(PDO::FETCH_OBJ);
    }

    /*****************************************methode Récuper les infos du patient pour l'afficher depuis ma liste  */

    public function getPatDetailsById()
    {
        $usersDetails = $this->db->prepare(
            'SELECT 
                `pat`.`id`
                ,`us`.`lastname`
               ,`us`.`firstname`
               ,DATE_FORMAT(`pat`.`birthDate`, \'%d/%m/%Y\') AS `birthDateFr` 
               ,`pat`.`birthDate`
               ,`pat`.`phoneNumbers`
               ,`us`.`mail`
               ,`pat`.`id_dom20_users`
           FROM 
               `dom20_users`  as `us`
           INNER JOIN  
                `dom20_patients` AS  `pat`
           ON `us`.`id` = `pat`.`id_dom20_users`
           WHERE
               `pat`.`id` = :id        
           '
        );
        $usersDetails->bindValue(':id', $this->id, PDO::PARAM_INT);
        $usersDetails->execute();
        return $usersDetails->fetch(PDO::FETCH_OBJ);
    }
}
