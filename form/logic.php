<?php
    class Logic {
        private $data;

        public function __construct(){
            $url = isset($_POST['url']) ? $_POST['url'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $this->data = array(
                "url" => $url,
                "username" => $username,
                "password" => $password
            );
        }

        public function action(){
            foreach($this->data as $d){
                if(!$d){
                    header("Location: /form/form.php");
                }
            }
            $parser = new DataHandler($this->data['url']);
            $parser = json_decode($parser->getData());
            $sql = new AddData($this->data['username'], $this->data['password']);
            $sql->add($parser->content, $parser->date, $parser->title);
        }
    }