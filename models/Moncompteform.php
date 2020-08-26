<?php 
// la class est la définition de l'objet.
// private: accessible uniquement dans la class.
// protected: accessible dans la class et les enfants.
// public: dispo dans class, enfant et dans les instances.
class patients
{
    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthDate = '0000-00-00';
    public $phone = '';
    public $mail = '';
    private $db = NULL;
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=keneya;charset=utf8', 'root', '');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    // was samePatient
    public function checkPatientExist()
    {
        $addPatientSameQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isPatientExist`
            FROM `patients` 
            WHERE `lastname` = :lastname AND `firstname` = :firstname AND `mail` = :mail'
        );
        $addPatientSameQuery->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addPatientSameQuery->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
        $addPatientSameQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $addPatientSameQuery->execute();
        $data = $addPatientSameQuery->fetch(PDO::FETCH_OBJ);
        return $data->isPatientExist; 
    } 
    // j'ai essayer de retourner, mais je n'ai pas mis de valeur qui me permettrait de savoir si il y a une similitude ou non, elle me permettra de la récupérer et de l'utiliser
    public function addPatient()
    {
        //$db devient une instance de l'objet PDO
        // on fait une requête préparée
        $addPatientQuery = $this->db->prepare(
            // Marqueur nominatif
            //bindValue: vérifie le type et que ça ne génère pas de faille de sécurité.
            //$this-> : permet d'acceder aux attributs de l'instance qui est en cours
            'INSERT INTO `patients` (`lastname`,`firstname`,`birthDate`,`phone`,`mail`)
    VALUES(:lastname, :firstname, :birthDate, :phone, :mail )'
        );
        $addPatientQuery->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
        $addPatientQuery->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
        $addPatientQuery->bindvalue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $addPatientQuery->bindvalue(':phone', $this->phone, PDO::PARAM_STR);
        $addPatientQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        return $addPatientQuery->execute();
    }
    public function getPatientsList() {
        $getPatientsListQuery = $this->db->query(
            'SELECT `id`, `lastname`, `firstname`, `mail`, DATE_FORMAT(`birthDate`, \'%d/%m/%Y\') AS `birthDateFr` 
            FROM `patients`
            ORDER BY `lastname` AND `firstname`');
        return $getPatientsListQuery->fetchAll(PDO::FETCH_OBJ);
    }
    public function getProfilPatient() {
        $getProfilPatientQuery = $this->db->prepare(
            'SELECT`lastname`, `firstname`, `mail`, `birthDate`, `phone`
            FROM `patients`
            WHERE `id` = :id'
        );
        $getProfilPatientQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $getProfilPatientQuery->execute();
        $data = $getProfilPatientQuery->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    public function modifyPatientInfo(){
        $modifyPatientInfoQuery = $this->db->prepare(
            'UPDATE `patients` 
            SET `lastname` = :lastname, `firstname` = :firstname, `mail` = :mail, `birthDate` = :birthDate, `phone` = :phone
            WHERE `id` = :id'
        );
        $modifyPatientInfoQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $modifyPatientInfoQuery->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
        $modifyPatientInfoQuery->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
        $modifyPatientInfoQuery->bindvalue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $modifyPatientInfoQuery->bindvalue(':phone', $this->phone, PDO::PARAM_STR);
        $modifyPatientInfoQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        return $modifyPatientInfoQuery->execute();
    }
}

