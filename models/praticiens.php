<?php 
class doctor {
    public $id = 0;
    public $matricule = '';
    public $phoneNumbers = '';
    public $price = '';
    public $accepted = '';
    public $id_dom20_users = '';
    public $id_dom20_specialities = '';
    public $id_dom20_practiceplace = '';
    private $table = '`dom20_doctors`';
    public $db = NULL;

    public function __construct() {
      $this->db = dataBase::getInstance();
  }

  
    /********Verification de l existance du Docteur *********
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
      } else if($field == 'id_dom20_users') {
        $checkUserUnavailabilityByFieldName->bindValue(':id_dom20_users', $this->id_dom20_users, PDO::PARAM_INT);
      } else {
          $checkUserUnavailabilityByFieldName->bindValue(':' . $field, $this->$field, PDO::PARAM_STR);
      }
      $checkUserUnavailabilityByFieldName->execute();
      return $checkUserUnavailabilityByFieldName->fetch(PDO::FETCH_OBJ)->isUnavailable;
  }

    /***ajouter un Doctor */
    public function addDoctor() {
      
        //$db devient une instance de l'objet PDO
        // on fait une requête préparée
      $addDoctorQuery = $this->db->prepare(
        //  :. Marqueur nominatif
        //bindValue: vérifie le type et que ça ne génère pas de faille de sécurité.
        //$this-> : permet d'acceder aux attributs de l'instance qui est en cours
        'INSERT INTO `dom20_doctors` (`matricule`,`id_dom20_practiceplace`,`phoneNumbers`,`price`,`accepted`,`id_dom20_users`,`id_dom20_specialities`)
          VALUES(:matricule, :id_dom20_practiceplace,:phoneNumbers,:price,:accepted,:id_dom20_users, :id_dom20_specialities )'
      );
      $addDoctorQuery->bindvalue(':matricule', $this->matricule, PDO::PARAM_STR_CHAR);
      $addDoctorQuery->bindvalue(':id_dom20_practiceplace', $this->id_dom20_practiceplace, PDO::PARAM_STR_CHAR);
      $addDoctorQuery->bindvalue(':phoneNumbers',$this->phoneNumbers, PDO::PARAM_STR);
      $addDoctorQuery->bindvalue(':price', $this->price, PDO::PARAM_INT);
      $addDoctorQuery->bindvalue(':accepted', $this->accepted, PDO::PARAM_STR);
      $addDoctorQuery->bindvalue(':id_dom20_users', $this->id_dom20_users, PDO::PARAM_INT);
      $addDoctorQuery->bindvalue(':id_dom20_specialities', $this->id_dom20_specialities, PDO::PARAM_INT);
      return $addDoctorQuery->execute();
    }
  
    /**
     * Permet de savoir si un praticien existe.
     * Il retourne :
     *  - 0 quand il n'y a pas de praticien
     *  - 1 quand il y en a un
     */
  public function checkIdDoctorExist() {
    //check si l'id du docteur existe, retourne 1 si oui, 0 sinon
    $checkIdDoctorExistQuery = $this->db->prepare(
        'SELECT 
            COUNT(id) AS isIdDoctorExist
        FROM `dom20_doctors`
        WHERE id = :id
    ');
    $checkIdDoctorExistQuery->bindvalue(':id', $this->id, PDO::PARAM_INT);
    $checkIdDoctorExistQuery->execute();
    $data = $checkIdDoctorExistQuery->fetch(PDO::FETCH_OBJ);
    return $data->isIdDoctorExist; 
    }
  
   
  /******Modifier le doctor******************/
  public function modifyDoctor(){
    $modifyDoctorQuery = $this->db->prepare(
        'UPDATE 
           `dom20_doctors`
        SET  
           id_dom20_practiceplace = :id_dom20_practiceplace
           ,price = :price
           ,phoneNumbers = :phoneNumbers
           ,id_dom20_users = :id_dom20_users
           ,id_dom20_specialities = :id_dom20_specialities 
        WHERE `id_dom20_users` = :id_dom20_users
    ');
    $modifyDoctorQuery ->bindvalue(':id_dom20_practiceplace', $this->id_dom20_practiceplace, PDO::PARAM_STR_CHAR);
    $modifyDoctorQuery ->bindvalue(':price', $this->price, PDO::PARAM_INT);
    $modifyDoctorQuery ->bindvalue(':phoneNumbers', $this->phoneNumbers, PDO::PARAM_STR);
    $modifyDoctorQuery ->bindvalue(':id_dom20_users', $this->id_dom20_users, PDO::PARAM_INT);
    $modifyDoctorQuery ->bindvalue(':id_dom20_specialities', $this->id_dom20_specialities, PDO::PARAM_INT);
      return $modifyDoctorQuery ->execute();
} 

  /*********************************Recuperation Id Patient************************************/
  public function getDoctorIdByUserId()
  {
      $getUserIdQuery = $this->db->prepare(
          'SELECT `id`
          FROM  `dom20_doctors`
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
          FROM  `dom20_doctors`
          WHERE `id` = :id
      '
      );
      $getUserIdQuery->bindValue('id', $this->id, PDO::PARAM_INT);
      $getUserIdQuery->execute();
      return $getUserIdQuery->fetch(PDO::FETCH_OBJ);
  }
  
/********************************************Recuperation liste de docteur******************************* */

      function getDoctorList() {
        $getDoctorList = $this->db->query ( 
            'SELECT 
                `us`.`lastname`
                ,`us`.`firstname`
                ,`spe`.`name`
                ,`us`.`mail`
            FROM 
                `dom20_users`  AS `us`
                INNER JOIN  
                    `dom20_doctors` AS  `doc`
                ON 
                    `us`.`id` = `doc`.`id_dom20_users` 
                INNER JOIN 
                    `dom20_specialities` AS `spe` 
                ON  
                    `spe`.`id` = `doc`.`id_dom20_specialities`
            WHERE
                `us`.`id` = :id    
            ORDER BY `lastname` ASC
        ');
        // fetchAll permet de recuperer un tableau d'objet
        return $getDoctorList->fetchAll(PDO::FETCH_OBJ);
      }


      function getDoctorListLimited($limitArray = array() ,$searchArray = array()) {
        if(count($searchArray) > 0){
          $where = ' WHERE ';
          foreach($searchArray as $fieldName => $search) {
            // strrchr — Trouve la dernière occurrence d'un caractère dans une chaîne
              if (strrchr($search, '%')){
                  $whereArray[] = '`' . $fieldName . '` LIKE :' . $fieldName ;
              }else {
                  $whereArray[] = '`' . $fieldName . '` = :' . $fieldName ;
              }
          }
         // implode — Rassemble les éléments d'un tableau en une chaîne
          $where .= implode(' AND ', $whereArray); 
        }
        $getDoctorListLimited = $this->db->prepare(
          'SELECT 
                  `us`.`id`
                  ,`us`.`id` AS `usid`
                  ,`us`.`lastname`
                  ,`us`.`firstname`
                  ,`spe`.`name`
                  ,`us`.`mail`
                  ,`doc`.`id` AS `docId`
              FROM `dom20_users`  AS `us`              
                  INNER JOIN `dom20_doctors` AS  `doc`
                          ON `us`.`id` = `doc`.`id_dom20_users`
                  INNER JOIN `dom20_specialities` AS `spe` 
                          ON  `spe`.`id` = `doc`.`id_dom20_specialities` '
              . (isset($where) ? $where : '') . 
              ' ORDER BY `lastname` ASC '
              . (count($limitArray) == 2 ? 'LIMIT :limit OFFSET :offset' : '')
        );
        foreach($searchArray as $fieldName => $search) {
          $getDoctorListLimited->bindvalue(':' . $fieldName, $search , PDO::PARAM_STR);
        }
        if (count($limitArray) == 2){
          $getDoctorListLimited->bindvalue(':limit', $limitArray['limit'], PDO::PARAM_INT);
          $getDoctorListLimited->bindvalue(':offset', $limitArray['offset'], PDO::PARAM_INT);
        }
        $getDoctorListLimited->execute();
        return $getDoctorListLimited->fetchAll(PDO::FETCH_OBJ); 
      }  
      

    /*****************************************methode Récuper les infos du docteur pour l'afficher depuis ma liste  */  
    public function getDocDetailsById() {
      $getDocDetailsById = $this->db->prepare(
      'SELECT 
                `doc`.`id`
               ,`us`.`lastname`
               ,`us`.`firstname`
               ,`us`.`mail`
               ,`doc`.`phoneNumbers`
               ,`doc`.`price`
               ,`spe`.`name`
               ,`pla`.`placename`
               , `doc`.`id_dom20_practiceplace`
               , `doc`.`id_dom20_specialities`
               , `doc`.`id_dom20_users`
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
                `doc`.`id` = :id
            ');
       $getDocDetailsById->bindValue(':id', $this->id, PDO::PARAM_INT);
       $getDocDetailsById->execute();
       return $getDocDetailsById->fetch(PDO::FETCH_OBJ); 
    }
          
}   

