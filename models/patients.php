<?php 

class patient {

    public $id = 0;
    public $birthDate = '';
    public $phoneNumber= '';
    public $id_dom20_users= '';
    public $db = NULL;

    public function __construct() {
        $this->db = database::getInstance();
    }
    public function addPatient() {
      
        //$db devient une instance de l'objet PDO
        // on fait une requête préparée
      $addPatientQuery = $this->db->prepare(
        // Marqueur nominatif
        //bindValue: vérifie le type et que ça ne génère pas de faille de sécurité.
        //$this-> : permet d'acceder aux attributs de l'instance qui est en cours
        'INSERT INTO `dom20_users` (`birthDate`,`phoneNumbers`,id_dom20_users)
          VALUES(:birthDate, :phoneNumber, :id_dom20_users )'
      );
      $addPatientQuery->bindvalue(':birthDate', $this->birthDate, PDO::PARAM_STR);
      $addPatientQuery->bindvalue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
      $addPatientQuery->bindvalue(':id_dom20_users', $this->id_dom20_users, PDO::PARAM_INT);
      return $addPatientQuery->execute();
    }
}
