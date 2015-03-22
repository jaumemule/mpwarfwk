<?php
namespace Mpwarfwk\Component\Model;

use PDO;

class PdoDatabase {

    private $database;

    public function __construct() {

        $this->database = new PDO('mysql:dbname=framework;host=localhost', 'root', 'strongpassword');
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        echo " - estoy en la base de datos, de momento solo me ejecuto - ";
    }

    public function selectAllFromTable($table) {

        $statement = $this->database->prepare("SELECT * FROM $table");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function selectFromTable($query, $data = NULL) {

        //ESPERA RECIBIR QUERIES CON ESTA ESTRUCTURA => 
        //"SELECT email FROM subscribers" o "SELECT email FROM subscribers WHERE id = :id"

        $statement = $this->database->prepare($query);
        if($data != NULL){
            foreach ($data as $key => $actualValue) {
                $statement->bindValue(":$key", $actualValue);
            }
        }
        $statement->execute();
        return $statement->fetchAll();
    }


    public function insertInTable($query, $data) {

        //ESPERA RECIBIR QUERIES CON ESTA ESTRUCTURA => "INSERT INTO subscribers SET email = :email"
        $statement = $this->database->prepare($query);
        foreach ($data as $key => $actualValue) {
            $statement->bindValue(":$key", $actualValue);
        }
        return $statement->execute();
    }

    public function deleteFromTable($table, $id, $value) {

        $statement = $this->database->prepare("DELETE FROM $table WHERE $id = '$value' LIMIT 1");
        return $statement->execute();
    }

    public function updateTable($query, $data) {
        
        //ESPERA RECIBIR QUERIES CON ESTA ESTRUCTURA => "UPDATE subscribers SET email = :email WHERE id = :id" 
        $statement = $this->database->prepare($query);
        foreach ($data as $key => $actualValue) {
            $statement->bindValue(":$key", $actualValue);
        }
        return $statement->execute();
    }  
}