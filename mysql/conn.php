<?php
    class Connection {
        private $dns;
        private $username;
        private $password;

        public function __construct($dns, $username, $password) {
            $this->dns = $dns;
            $this->username = $username;
            $this->password = $password;
        }

        public function connectDb(){
            try {
                $connection = new PDO($this->dns, $this->username, $this->password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;
            } catch(PDOExeption $e) {
                return 'Error: ' . $e->getMessage();
            }
        }
    }