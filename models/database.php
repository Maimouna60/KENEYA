<?php
class dataBase
{
    public $db = null;
    private static $instance = null;
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=keneya;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    //Singleton
    //Static signifie que je ne peux pas y accèder via l'instance. 
    // on y accède de cette façon: nomClass::methode() ou nomClass::attribut
    public static function getInstance()
    {
        //On créer une instance PDO si et seulement si il en n'existe pas déjà une
        if (is_null(self::$instance)) {
            self::$instance = new dataBase();
        }
        return self::$instance->db;
    }
}
