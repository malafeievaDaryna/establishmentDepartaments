<?php

require_once "${_SERVER['DOCUMENT_ROOT']}/core/Logger.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/model/Model_Base.php";

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

class Model_User extends Model_Base {

    public const TABLE = "user";

    function insertData($user): bool {
        if ($user instanceof User) 
        {
            $sql = "INSERT INTO " . static::TABLE . " (USER, EMAIL, PHONE, ADDRESS, ABOUT, DEPARTAMENT_ID)
                VALUES ('" . htmlspecialchars($user->user) . "' , '" . htmlspecialchars($user->email) .
                    "' , '" . htmlspecialchars($user->phone) . "' , '" . htmlspecialchars($user->address) .
                    "' , '" . htmlspecialchars($user->about) . "' , '" . $user->departament_id . "');";
            Logger::getInstance()->log(__METHOD__ . " " . $sql);
            return $this->conn->executeQuery($sql);
        } else 
        {
            return false;
        }
    }
    
    function getRows() : array {
        $arr = [];
        $sql = "SELECT ID, USER, EMAIL, PHONE, ADDRESS, ABOUT, DEPARTAMENT_ID FROM " . static::TABLE . ";";
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
