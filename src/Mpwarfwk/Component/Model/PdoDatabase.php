<?php
namespace Mpwarfwk\Component\Model;

use PDO;

class PdoDatabase{

    private $database;

    //SIMPLE MOST USED DATA
    private $conversion_data = array(
            'integer'           => PDO::PARAM_INT ,
            'string'            => PDO::PARAM_STR ,
            'input_output'      => PDO::PARAM_INPUT_OUTPUT ,
            'bool'              => PDO::PARAM_BOOL  ,
            'null'              => PDO::PARAM_NULL  ,
            'lob'               => PDO::PARAM_LOB   ,
            'number'            => PDO::FETCH_NUM    ,
        );

    public function __construct(DBconnection $DBconnection) {

        $this->database = new PDO('mysql:dbname='.DBconnection::$database.';host='.DBconnection::$host.'', ''.DBconnection::$username.'', ''.DBconnection::$password.'');

        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function selectAllFromTable($table) {

        $statement = $this->database->prepare("SELECT * FROM $table");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function selectFromTable($query, $data = NULL) {

        $statement = $this->database->prepare($query);
        if($data != NULL){
            foreach ($data as $key => $actualValue) {
                $statement->bindValue(":$key", $actualValue);
            }
        }
        $statement->execute();
        return $statement->fetchAll();
    }

    public function selectFromTableBindData($query, $data) {

        $statement = $this->database->prepare($query);
        if($data != NULL){
            foreach ($data as $key => $actualValue) {
                $statement->bindParam(":$key", $actualValue[$key], $this->conversion_data[$actualValue['type']], $actualValue['lenght']);
            }
        }
        $statement->execute();
        return $statement->fetchAll();
    }

    public function insertInTableBindData($query, $data) {

        $statement = $this->database->prepare($query);
        foreach ($data as $key => $actualValue) {
                $statement->bindParam(":$key", $actualValue[$key], $this->conversion_data[$actualValue['type']], $actualValue['lenght']);
        }
        return $statement->execute();
    }


    public function updateTableBindData($query, $data) {
        
        $statement = $this->database->prepare($query);
        foreach ($data as $key => $actualValue) {
            $statement->bindParam(":$key", $actualValue[$key], $this->conversion_data[$actualValue['type']], $actualValue['lenght']);
        }
        return $statement->execute();
    }  


    public function insertInTable($query, $data) {

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

    public function deleteFromFreeQuery($query) {

        $statement = $this->database->prepare($query);
        return $statement->execute();
    }

    public function updateTable($query, $data) {
        
        $statement = $this->database->prepare($query);
        foreach ($data as $key => $actualValue) {
            $statement->bindValue(":$key", $actualValue);
        }
        return $statement->execute();
    }  

    public function lastInsertID()
    {
        return $this->database->lastInsertId();
    }
}