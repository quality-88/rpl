<?php


    define('DB_SERVER', 'www.portaluniversitasquality.ac.id');
    define('DB_PORT', '85');
    define('DB_DATABASE', 'qualitydb');
    define('DB_USERNAME', 'keuangan');
    define('DB_PASSWORD', 'BPKQuality888!@#');


    class __Database
    {
        private $connection;

        public function __construct() 
        {
            $this->connect();   
        }

        private function connect() 
        {
            $dsn = "sqlsrv:server=" . DB_SERVER . "," . DB_PORT . ";Database=" . DB_DATABASE;

            try {

                $this->connection = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::SQLSRV_ATTR_QUERY_TIMEOUT, 90);

            } catch ( PDOException $e ) {

                echo "Connection failed: " . $e->getMessage();
                
            }
        }

        public function prepare($query)
        {
            return $this->connection->prepare($query);
        }

        public function query($query, $params = [])
        {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function queryid($query, $params = [])
        {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function queryrow($query, $params = [])
        {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        }

        public function beginTransaction()
        {
            $this->connection->beginTransaction();
        }

        public function commit()
        {
            $this->connection->commit();
        }

        public function rollback()
        {
            $this->connection->rollBack();
        }

        public function __destruct() 
        {
            $this->connection = null;
        }
    }