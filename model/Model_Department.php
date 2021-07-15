<?php

require_once "${_SERVER['DOCUMENT_ROOT']}/core/Logger.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/model/Model_Base.php";

class Department {
    
    function __construct(public string $department, 
                         public int $id = 0)
    {
    }
}

class Model_Department extends Model_Base {

    public const TABLE = "departament";

    function insertData($department): bool {
        if ($department instanceof Department) 
        {
            $sql = "INSERT INTO " . static::TABLE . " (DEPARTAMENT)
                VALUES ('" . htmlspecialchars($department->department) . "');";
            Logger::getInstance()->log(__METHOD__ . " " . $sql);
            return $this->conn->executeQuery($sql);
        } else 
        {
            return false;
        }
    }
    
    function getRows() : array {
        $arr = [];
        $sql = "SELECT ID, DEPARTAMENT FROM " . static::TABLE . ";";
        Logger::getInstance()->log(__METHOD__ . " " . $sql);
        if ($result = $this->conn->executeQuery($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                    Logger::getInstance()->log("id: " . $row->ID . " DEPARTAMENT: " . $row->DEPARTAMENT);
                    $department = new Department($row->DEPARTAMENT, $row->ID);
                    array_push($arr, $department);
                }
            } else {
                Logger::getInstance()->log("0 results");
            }
        }
        
        return $arr;
    }
    
    function getRowsAsKeyValue() : array {
        $arr = [];
        $sql = "SELECT ID, DEPARTAMENT FROM " . static::TABLE . ";";
        Logger::getInstance()->log(__METHOD__ . " " . $sql);
        if ($result = $this->conn->executeQuery($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                    Logger::getInstance()->log("id: " . $row->ID . " DEPARTAMENT: " . $row->DEPARTAMENT);
                    $arr[$row->ID] = $row->DEPARTAMENT;
                }
            } else {
                Logger::getInstance()->log("0 results");
            }
        }
        
        return $arr;
    }

}
?>
