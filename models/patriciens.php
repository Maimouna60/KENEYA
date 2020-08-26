<?php 
$arrayError = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $user->role ='3';
    $pdo->beginTransaction();
    $pdo->commit();
} 
catch (\Exception $e) {
    if ($this->db->inTransaction()) {
        $this->db->rollback();
    }
    throw $e;
}
// la class est la définition de l'objet.
// private: accessible uniquement dans la class.
// protected: accessible dans la class et les enfants.
// public: dispo dans class, enfant et dans les instances.
class praticiens
{
    public $id = 0;
    public $birthDate = '0000-00-00';
    public $phoneNumbers = '';
    public $mail = '';
    public $users = '0';
    private $db = NULL;
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=keneya;charset=utf8', 'root', '');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    // j'ai essayer de retourner, mais je n'ai pas mis de valeur qui me permettrait de savoir si il y a une similitude ou non, elle me permettra de la récupérer et de l'utiliser
    public function addPraticien()
    {
        //$db devient une instance de l'objet PDO
        // on fait une requête préparée
        $addPraticienQuery = $this->db->prepare(
            // Marqueur nominatif
            //bindValue: vérifie le type et que ça ne génère pas de faille de sécurité.
            //$this-> : permet d'acceder aux attributs de l'instance qui est en cours
            'INSERT INTO `patients` (`id`,`birthDate`,`phoneNumbers`,`mail`,id_dom20_users)
    VALUES(:id,:birthDate, :phoneNumbers, :mail,:users)'
        );
        $addPraticienQuery->bindvalue(':id', $this->id, PDO::PARAM_INT);
        $addPraticienQuery->bindvalue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $addPraticienQuery->bindvalue(':phoneNumbers', $this->phone, PDO::PARAM_STR);
        $addPraticienQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $addPraticienQuery->bindvalue(':users', $this->users, PDO::PARAM_INT);
        return $addPraticienQuery->execute();
    }
    public function checkIdPatricienExist()
    {
        $checkPatricienExistQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isPatricienExist`
            FROM `dom20_doctors` 
            WHERE `firsname` = :firstname
                  `lastname` = :lastname
                  `mail` = :mail'
        );
        $checkPatricienExistQuery->bindvalue(':firstname', $this->firstname, PDO::PARAM_STR);
        $checkPatricienExistQuery->bindvalue(':lastname', $this->lastname, PDO::PARAM_STR);
        $checkPatricienExistQuery->bindvalue(':mail', $this->mail, PDO::PARAM_STR);
        $checkPatricienExistQuery->execute();
        $data = $checkPatricienExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isUserExist;
    }
} 
