<?php

require_once "${_SERVER['DOCUMENT_ROOT']}/core/Logger.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/core/db_connection.php";

class User {
    
    function __construct(public int $id, 
                         public string $user, 
                         public string $email, 
                         public string $phone, 
                         public string $address, 
                         public string $about, 
                         public int $departament_id)
    {
    }
}

class Model_User {

    private Connection $conn;
    public const TABLE = "user";

    function __construct(Connection $conn) {
        Logger::getInstance()->log(__METHOD__);
        $this->conn = $conn;
    }

    function insertUser(User $user): bool {
        Logger::getInstance()->log(__METHOD__ . " " . $sql);
        $sql = "INSERT INTO " . self::TABLE . " (USER, EMAIL, PHONE, ADDRESS, ABOUT, DEPARTAMENT_ID)
                VALUES ('" . htmlspecialchars($user->user) . "' , '" . htmlspecialchars($user->email) . 
                "' , '" . htmlspecialchars($user->phone) . "' , '" . htmlspecialchars($user->address) .
                "' , '" . htmlspecialchars($$user->about) . "' , '" . htmlspecialchars($$user->departament_id) . "');";
        Logger::getInstance()->log(__METHOD__ . " " . $sql);
        return $this->conn->executeQuery($sql);
    }
    
    function deleteUser(int $id): bool {
        $sql = "DELETE FROM " . self::TABLE ." WHERE ID = $id;";
        Logger::getInstance()->log(__METHOD__ . " " . $sql);
        return $this->conn->executeQuery($sql);
    }
    
    function getUsers() : array {
        $arr = [];
        $sql = "SELECT USER, EMAIL, PHONE, ADDRESS, ABOUT, DEPARTAMENT_ID FROM " . self::TABLE . ";";
        Logger::getInstance()->log(__METHOD__ . " " . $sql);
        if ($result = $this->executeQuery($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                    Logger::getInstance()->log("id: " . $row->ID . " Name: " . $row->USER . " PHONE " . $row->PHONE);
                    array_push($arr, $row);
                }
            } else {
                Logger::getInstance()->log("0 results");
            }
        }
        
        return $arr;
    }

}
?>
