<?php
    namespace App\Mysql;
    class AddData {
        /**
         * @var PDO
         */
        protected $connection;
        protected $username;
        protected $password;

        /**
         * @param $username string
         * @param $password string
         */
        public function __construct($username, $password) {
            $this->username = $username;
            $this->password = $password;
            $this->createConnect();
        }

        /**
         * @param $content string
         * @param $date string
         * @param $title string
         * add data to database
         */
        public function add($content, $date, $title){
            try {
                $query = $this->connection->prepare("INSERT INTO warrper_data (content, date, title)
                VALUES (:content, :date, :title)
                ");
                $query->bindParam(':content', $content);
                $query->bindParam(':date', $date);
                $query->bindParam(':title', $title);
                $query->execute();
                return true;
            } catch (PDOExeption $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }

        protected function createConnect()
        {
            $conn = new Connection('mysql:host=localhost;dbname=curl_php', $this->username, $this->password);
            $this->connection = $conn->connectDb();
        }
    }