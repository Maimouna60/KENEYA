<?php
    class appointement{
        //public est accessible dans la classe, ses enfant et ses instances
        //on declare les variable avec des contenue neutre
        public $id = 0;
        public $dateHour = '0000-00-00 00:00:00';
        public $idPatient = 0;
        private $db = NULL;
        public function __construct() {
            $this->db = dataBase::getInstance();
        }
        //une fonction dans une classe est une methode
        public function addAppointement() {
            $addAppointement = $this->db->prepare(
                'INSERT INTO 
                    `appointments` (`dateHour`, `idPatients`) 
                VALUES 
                    (
                    :AppointementDateTime
                    ,:patientId
                    )
                ');
                // :lastname est un marqueur nominatif
            $addAppointement->bindValue(':AppointementDateTime', $this->dateHour, PDO::PARAM_STR);
            $addAppointement->bindValue(':patientId', $this->idPatient, PDO::PARAM_INT);
            return $addAppointement->execute();    
            
        }
        function getAppointementsList() {
            $getAppointementList = $this->db->query(
                //reformate la date sur le format francais
                'SELECT 
                    `app`.`id`
                    ,DATE_FORMAT(`app`.`dateHour`, \'%H:%i \') AS `timeFR` 
                    ,DATE_FORMAT(`app`.`dateHour`, \'%d/%m/%Y\') AS `dateFR`
                    ,`app`.`dateHour`
                    , `app`.`idPatients` 
                    , `pat`.`lastname`
                    , `pat`.`firstname`
                    ,`pat`.`phone`
                FROM 
                    `dom20_appointments` AS `app`
                    INNER JOIN `patients` AS `pat`
                    ON `app`.`idPatients` = `pat`.`id`
                ORDER BY `dateHour` ASC
            ');
            // fetchAll permet de recuperer un tableau d'objet
            return $getAppointementList->fetchAll(PDO::FETCH_OBJ);
        }
        public function getAppointementDetails() {
            $getAppointementDetails = $this->db->prepare(
                'SELECT 
                    `app`.`id`
                    ,DATE_FORMAT(`app`.`dateHour`, \'%H:%i \') AS `timeFR` 
                    ,DATE_FORMAT(`app`.`dateHour`, \'%d/%m/%Y\') AS `dateFR`
                    ,DATE_FORMAT(`app`.`dateHour`, \'%Y-%m-%d\') AS `dateEn`
                    ,DATE_FORMAT(`app`.`dateHour`, \'%H:%i:%s\') AS `timeEn`
                    ,`dateHour` 
                    , `app`.`idPatients` 
                    , `pat`.`lastname`
                    , `pat`.`firstname`
                    ,`pat`.`phone`
                    , `pat`.`mail`
                FROM 
                    `appointments` AS `app`
                    INNER JOIN `patients` AS `pat`
                    ON `app`.`idPatients` = `pat`.`id`
                WHERE
                    `app`.`id` = :appointementId
                ');
                $getAppointementDetails->bindValue(':appointementId', $this->id, PDO::PARAM_INT);
                $getAppointementDetails->execute();
                return $getAppointementDetails->fetch(PDO::FETCH_OBJ);
        }
        public function modifyAppointement() {
            //update la table patient
            $modifyAppointement = $this->db->prepare(
                'UPDATE 
                    `appointments` 
                SET 
                    `dateHour`= :dateHour
                    ,`idPatients`= :idPatients
                WHERE
                    id = :appointementId 
                ');
                    $modifyAppointement->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
                    $modifyAppointement->bindValue(':idPatients', $this->idPatient, PDO::PARAM_INT);
                    $modifyAppointement->bindValue(':appointementId', $this->id, PDO::PARAM_STR);
                    return $modifyAppointement->execute();
        }
        public function getAppointementListforId() {
            $getAppointementList = $this->db->prepare(
                'SELECT 
                    `id`
                    ,DATE_FORMAT(`dateHour`, \'%H:%i \') AS `timeFR` 
                    ,DATE_FORMAT(`dateHour`, \'%d/%m/%Y\') AS `dateFR`
                FROM 
                    `appointments`
                WHERE
                    `idPatients` = :patientID
                ');
                $getAppointementList->bindValue(':patientID', $this->id, PDO::PARAM_INT);
                $getAppointementList->execute();
                return $getAppointementList->fetchAll(PDO::FETCH_OBJ);
        }
        public function deleteAppointementById() {
            $deleteAppointement = $this->db->prepare(
                'DELETE FROM 
                    `appointments`
                WHERE 
                    id = :appointementID
                ');
                $deleteAppointement->bindValue(':appointementID', $this->id, PDO::PARAM_INT);
                return $deleteAppointement->execute();
        }
        public function deleteAppointementByUserId() {
            $deleteAppointement = $this->db->prepare(
                'DELETE FROM 
                    `appointments`
                WHERE 
                    idPatients = :appointementID
                ');
                $deleteAppointement->bindValue(':appointementID', $this->id, PDO::PARAM_INT);
                return $deleteAppointement->execute();
        }
    }