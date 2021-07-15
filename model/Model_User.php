<?php

require_once "${_SERVER['DOCUMENT_ROOT']}/core/Logger.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/core/db_connection.php";

class User {
    
    function __construct(public string $user, 
                         public string $email, 
                         public string $phone, 
                         public string $address, 
                         public string $about, 
                         public int $departament_id,
                         public int $id = 0)
    {
    }
}

class Model_User {

    private Connection $conn;
    public const TABLE = "user";

    function __construct() {
        Logger::getInstance()->log(__METHOD__);
        $this->conn = Connection::getInstance();
    }

    function insertUser(User $user): bool {
        $sql = "INSERT INTO " . self::TABLE . " (USER, EMAIL, PHONE, ADDRESS, ABOUT, DEPARTAMENT_ID)
                VALUES ('" . htmlspecialchars($user->user) . "' , '" . htmlspecialchars($user->email) . 
                "' , '" . htmlspecialchars($user->phone) . "' , '" . htmlspecialchars($user->address) .
                "' , '" . htmlspecialchars($user->about) . "' , '" . $user->departament_id . "');";
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
        $sql = "SELECT ID, USER, EMAIL, PHONE, ADDRESS, ABOUT, DEPARTAMENT_ID FROM " . self::TABLE . ";";
        Logger::getInstance()->log(__METHOD__ . " " . $sql);
        if ($result = $this->conn->executeQuery($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                    Logger::getInstance()->log("id: " . $row->ID . " Name: " . $row->USER . " PHONE " . $row->PHONE);
                    $user = new User($row->USER, $row->EMAIL, $row->PHONE, $row->ADDRESS, $row->ABOUT, $row->DEPARTAMENT_ID, $row->ID);
                    array_push($arr, $user);
                }
            } else {
                Logger::getInstance()->log("0 results");
            }
        }
        
        return $arr;
    }

}
?>
