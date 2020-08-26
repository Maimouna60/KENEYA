<?php
class user {
    public $id = 0;
    public $lastname= '';
    public $firstname= '';
    public $mail= '';
    public $password= '';
    public $role= 0;
    public $db = NULL;

    public function __construct() {
        $this->db = database::getInstance();
    }
    public function addUser() {
        //$db devient une instance de l'objet PDO
        // on fait une requête préparée
      $addUserQuery = $this->db->prepare(
        // Marqueur nominatif
        //bindValue: vérifie le type et que ça ne génère pas de faille de sécurité.
        //$this-> : permet d'acceder aux attributs de l'instance qui est en cours
        'INSERT INTO `dom20_users` (`id`,`lastname`,`firstname`,`mail`,`password`,`id_dom20_roles`)
          VALUES(:id,:lastname, :firstname, :mail, :password, :role )'
      );
      $addUserQuery->bindvalue(':id', $this->id, PDO::PARAM_INT);
      $addUserQuery->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
      $addUserQuery->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
      $addUserQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
      $addUserQuery->bindvalue(':password', $this->password, PDO::PARAM_STR);
      $addUserQuery->bindvalue(':role', $this->role, PDO::PARAM_STR);
      return $addUserQuery->execute();
    }
    public function checkUserExist()
    {
        $checkUserExistQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isUserExist`
            FROM `dom20_users` 
            WHERE `firstname` = :firstname
                  AND `lastname` = :lastname
                  AND `mail` = :mail'
        );
        $checkUserExistQuery->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
        $checkUserExistQuery->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
        $checkUserExistQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $checkUserExistQuery->execute();
        $data = $checkUserExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isUserExist;
}
}