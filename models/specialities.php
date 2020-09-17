<?php 

class specialities {
    public $id = 0;
    public $name = '';
    public $db = NULL;
    public function __construct()
    {
        $this->db = dataBase::getInstance();
    }

    public function getSpecialitiesName(){
        $getSpecialitiesNameQuery = $this->db->query(
            'SELECT `name`, `id`
            FROM `dom20_specialities`
            ORDER BY `name` ASC');
        return $getSpecialitiesNameQuery->fetchAll(PDO::FETCH_OBJ);
    }       
}