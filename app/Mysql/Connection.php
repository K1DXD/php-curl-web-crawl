<?php
    namespace App\Mysql;
    /**
     * connect to database
     */
    class Connection {
        private $dns;
        private $username;
        private $password;

        /**
         * @param $dns string
         * @param $username string
         * @param $password string
         */
        public function __construct($dns, $username, $password) {
            $this->dns = $dns;
            $this->username = $username;
            $this->password = $password;
        }

        /**
         * connect database
         * @return exception if fail
         */
        public function connectDb(){
            try {
                $connection = new \PDO($this->dns, $this->username, $this->password);
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $connection;
            } catch(PDOExeption $e) {
                return 'Error: ' . $e->getMessage();
            }
        }
    }