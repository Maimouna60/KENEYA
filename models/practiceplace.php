<?php 

class practiceplace {
    public $id = 0;
    public $placename = '';
    public $db = NULL;
    public function __construct()
    {
        $this->db = database::getInstance();
    }

    public function getPracticesPlaceName(){
        $getPracticesPlaceNameQuery = $this->db->query(
            'SELECT `placename`, `id`
            FROM `dom20_practiceplace`
            ORDER BY `placename` ASC');
        return $getPracticesPlaceNameQuery->fetchAll(PDO::FETCH_OBJ);
    }       
}