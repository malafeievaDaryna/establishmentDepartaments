<?php

require_once "${_SERVER['DOCUMENT_ROOT']}/core/Logger.php";
require_once "${_SERVER['DOCUMENT_ROOT']}/core/Connection.php";

abstract class Model_Base {
    
    public const TABLE = "override for inheritor";

    protected Connection $conn;

    function __construct() {
        Logger::getInstance()->log(__METHOD__);
        $this->conn = Connection::getInstance();
    }

    abstract function insertData(object $obj): bool;
    
    function deleteData(int $id): bool {
        $sql = "DELETE FROM " . static::TABLE ." WHERE ID = $id;";
        Logger::getInstance()->log(__METHOD__ . " " . $sql);
        return $this->conn->executeQuery($sql);
    }
    
    abstract function getRows() : array ;

}
?>
