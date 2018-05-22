<?php

namespace DeeWeb\Test_Blog\Model;

class Manager {

/**
 * Connexion to the DataBase.
 *
 * This protected PDO method will allow the connexion to the DataBase.
 * Please fill the DatabAse login inputs like shown on the description below.
 *
 * @param $host Represent the DB hosting adress.
 * @param $dbname Represent the DB name.
 * @param $dbuser Represent the DB user name.
 * @param $dbpw Represent the DB login password.
 *
 * @return object.
 */

    protected function dbConnect() {

        $host = 'localhost';        //myHostAdress
        $dbname = 'deeweb_mvc';     //myDataBaseName
        $dbuser = 'deeweb_fred';    //myUserName
        $dbpw = 'Lespaul96';        //myPassword

        $pdoReqArg1 = "mysql:host=". $host .";dbname=". $dbname .";";
        $pdoReqArg2 = $dbuser;
        $pdoReqArg3 = $dbpw;

        try {

            $db = new \PDO($pdoReqArg1, $pdoReqArg2, $pdoReqArg3);
            $db->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_LOWER);   
            $db->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
            $db->exec("SET NAMES 'utf8'");

            return $db;

        } catch(\PDOException $e) {

            $errorMessage = $e->getMessage();
        }
    }
}