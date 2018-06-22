<?php
/*
 * Created on 13 juil. 06
 *
 * @author Philippe Le Van (http://www.kitpages.fr)
 * @copyright 2005-2006
 */
include_once "Zend/Db.php";
 
class Kitpages_Tutoriaux_Facade {
    ////
    // singleton management
    ////
    static private $_instance = null;
    private function __construct() {
    }
    static public function getInstance() {
        if (!self::$_instance instanceof self) {
           self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    ////
    // connexion management
    ////
    private $db = null;
    public function getZendDb() {
        if ($this->db == null) {
            $params = array(
                'host'     => DB_SERVER ,
                'username' => DB_USER ,
                'password' => DB_PASSWORD ,
                'dbname'   => DB_NAME
            );
            $this->db = Zend_Db::factory(DB_TYPE,$params);
        }
        return $this->db;
    }
    
    /**
     * save comments
     * Note : pas besoin de s'occuper 
* des echapements, c'est pris en charge
     */
    public function saveComment($email,$subject,$content) {
        $db = $this->getZendDb();
        $valueArray = array("email"=>$email,
                            "subject"=>$subject,
                            "content"=>$content);
        $rows_affected = $db->insert("comment", $valueArray);
        return $db->lastInsertId();
    }
    
    /**
     * get all comments
     */
    public function getAllComments() {
        $db = $this->getZendDb();
        $select = $db->select();
        $select->from("comment", array(
                "id","email","subject","content"));
        $select->order("id DESC");
        return $db->fetchAll($select);
    }
}
?>