<?php
    namespace App\Form;
    use App\CrawlerLibrary\Warpper\DataHandler as DataHandler;
    use App\Mysql\AddData as AddData;
    /**
     * handle form input
     * check the url and add parse data to database
     */
    class Logic {
        /** @var array */
        private $data;

        /**
         * get username, password, url from POST resquest
         */
        public function __construct(){
            $url = empty($_POST['url']) ? false : $_POST['url'];
            $username = empty($_POST['username']) ? false : $_POST['username'];
            $password = empty($_POST['password']) ? false : $_POST['password'];
            $this->data = array(
                "url" => $url,
                "username" => $username,
                "password" => $password
            );
        }

        /**
         * get parse data and add to database
         */
        public function action(){
            $parser = new DataHandler($this->data['url']);
            if($parser = $parser->getData()){
                $parser = json_decode($parser);
                $sql = new AddData($this->data['username'], $this->data['password']);
                $sql->add($parser->content, $parser->date, $parser->title);
            }else {
                echo 'Invalid url!!!';
            }
        }
        
        /**
         * check data from form input
         */
        public function checkForm(){
            foreach($this->data as $d){
                if(!$d) return false;
            }
            return true;
        }
    }