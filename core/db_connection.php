<?php

require_once 'Logger.php';

class Connection {

    private const DB_CONFIG = "/core/db_config.json";
    
    private static ?Connection $instance = null;

    private $conn = NULL;

    private function __construct() {
        $config = json_decode (file_get_contents("${_SERVER['DOCUMENT_ROOT']}".self::DB_CONFIG));
        
        Logger::getInstance()->log(__METHOD__);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->conn = new mysqli($config->SERVERNAME, $config->USERNAME, $config->PASSWORD, $config->DBNAME);
        } catch (mysqli_sql_exception $e) {
            Logger::getInstance()->log("Connection failed: " . $e->__toString());
            die();
        }
    }
    
    private function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Connection
    {
        if(self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }
    
    function executeQuery(string $sql): mixed {
        $res = $this->conn->query($sql);
        if (!$res) {
            Logger::getInstance()->log("Error: " . $this->conn->error );
            return false;
        }
        else
        {
            return $res;
        }
    }

    function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

}
?>
