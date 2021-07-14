<?php

require_once 'Logger.php';

class Connection {

    private const DB_CONFIG = "db_config.json";

    private $conn = NULL;

    function __construct() {
        $config = json_decode (file_get_contents(DB_CONFIG));
        
        Logger::getInstance()->log(__METHOD__);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->conn = new mysqli($config->SERVERNAME, $config->USERNAME, $config->PASSWORD, $config->DBNAME);
        } catch (mysqli_sql_exception $e) {
            Logger::getInstance()->log("Connection failed: " . $e->__toString());
            die();
        }
    }
    
    private function executeQuery(string $sql): bool {
        $res = $this->conn->query($sql);
        if (!$res) {
            Logger::getInstance()->log("Error: " . $this->conn->error );
            return false;
        }
        else
        {
            return true;
        }
    }

    function __destruct() {
        Logger::getInstance()->log(__METHOD__ );
        if ($this->conn) {
            $this->conn->close();
        }
    }

}
?>
