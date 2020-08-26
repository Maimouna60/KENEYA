<?php
class appointments{
    public $id = 0;
    public $dateHour = '0000-00-00 00:00:00';
    public $idPatients = 0;
    private $db = NULL;
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=keneya;charset=utf8', 'root', '');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    public function checkAppointmentExist(){
        $checkAppointmentExistQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isAppointmentExist`
            FROM `appointments`
            WHERE `dateHour` = :dateHour AND `idPatients` = :idPatients'
        ); 
        $checkAppointmentExistQuery->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $checkAppointmentExistQuery->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        $checkAppointmentExistQuery->execute();
        //stocker l'objet dans la variable data
        $data = $checkAppointmentExistQuery->fetch(PDO::FETCH_OBJ);
        //retourner l'attribut isAppointmentExist de type booléen (COUNT renvoie 0 ou 1 qui peut etre interpreté comme un booléen) 
        return $data->isAppointmentExist;
    }
    public function checkAppointmentExistById(){
        $checkAppointmentExistQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isAppointmentExist`
            FROM `appointments`
            WHERE `id` = :id'
        ); 
        $checkAppointmentExistQuery->bindValue(':id', $this->id, PDO::PARAM_STR);
        $checkAppointmentExistQuery->execute();
        //stocker l'objet dans la variable data
        $data = $checkAppointmentExistQuery->fetch(PDO::FETCH_OBJ);
        //retourner l'attribut isAppointmentExist de type booléen (COUNT renvoie 0 ou 1 qui peut etre interpreté comme un booléen) 
        return $data->isAppointmentExist;
    }
    public function checkAppointmentExistByIdPatients(){
        $checkAppointmentExistByIdPatientsQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isAppointmentExist`
            FROM `appointments`
            WHERE `idPatients` = :idPatients'
        ); 
        $checkAppointmentExistByIdPatientsQuery->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        $checkAppointmentExistByIdPatientsQuery->execute();
        //stocker l'objet dans la variable data
        $data = $checkAppointmentExistByIdPatientsQuery->fetch(PDO::FETCH_OBJ);
        //retourner l'attribut isAppointmentExist de type booléen (COUNT renvoie 0 ou 1 qui peut etre interpreté comme un booléen) 
        return $data->isAppointmentExist;
    }
    public function addAppointment(){
        $addAppointmentQuery = $this->db->prepare(
            'INSERT INTO `appointments`(`idPatients`, `dateHour`)
            VALUES (:idPatients, :dateHour)'
        );
        $addAppointmentQuery->bindValue(':idPatients', $this->idPatients, PDO::PARAM_STR);
        $addAppointmentQuery->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        return $addAppointmentQuery->execute();
    }
    public function getAppointmentList(){
        $appointmentListQuery = $this->db->query(
            'SELECT `appointments`.`id`, `firstname`, `lastname`, DATE_FORMAT(`dateHour`, \'%d-%m-%Y\') AS `dateFr`, DATE_FORMAT(`dateHour`, \'%kh%i\') AS `hour`
            FROM `appointments`
            INNER JOIN `patients` ON `idPatients` = `patients`.`id`'
        );
        return $appointmentListQuery->fetchAll(PDO::FETCH_OBJ);
    }
    public function getAppointmentListById(){
        $getAppointmentListByIdQuery = $this->db->prepare(
            'SELECT `appointments`.`id`, DATE_FORMAT(`dateHour`, \'%d-%m-%Y\') AS `dateFr`, DATE_FORMAT(`dateHour`, \'%kh%i\') AS `hour`
            FROM `appointments`
            INNER JOIN `patients` ON `idPatients` = `patients`.`id`
            WHERE `idPatients` = :idPatients
            ORDER BY `dateFr` ASC, `hour` ASC'
        );
        $getAppointmentListByIdQuery->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        $getAppointmentListByIdQuery->execute();
        return $getAppointmentListByIdQuery->fetchAll(PDO::FETCH_OBJ);
    }
    public function getAppointmentInfo(){
        $appointmentInfoQuery = $this->db->prepare(
            'SELECT `idPatients`, `firstname`, `lastname`, `phone`, `mail`,DATE_FORMAT(`dateHour`, \'%d-%m-%Y\') AS `dateFr`, DATE_FORMAT(`dateHour`, \'%Y-%m-%d\') AS `date`, DATE_FORMAT(`dateHour`, \'%kh%i\') AS `hour`
            FROM `appointments`
            INNER JOIN `patients` ON `idPatients` = `patients`.`id`
            WHERE `appointments`.`id` = :id'
         );
         $appointmentInfoQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
         $appointmentInfoQuery->execute();
         return $appointmentInfoQuery->fetch(PDO::FETCH_OBJ);
    }
    public function updateAppointment(){
        $updateAppointmentQuery = $this->db->prepare(
            'UPDATE `appointments`
            SET `dateHour` = :dateHour , `idPatients` = :idPatients
            WHERE `id` = :id'
        );
        $updateAppointmentQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateAppointmentQuery->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $updateAppointmentQuery->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $updateAppointmentQuery->execute();
    }
    public function deleteAppointment(){
        $deleteAppointmentQuery = $this->db->prepare(
            'DELETE FROM `appointments`
            WHERE `id` = :id'
        );
        $deleteAppointmentQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteAppointmentQuery->execute();
    }
    public function deleteAppointmentByIdpatients(){
        $deleteAppointmentByIdpatients = $this->db->prepare(
            'DELETE FROM `appointments`
            WHERE `idPatients` = :idPatients'
        );
        $deleteAppointmentByIdpatients->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $deleteAppointmentByIdpatients->execute();
    }
}