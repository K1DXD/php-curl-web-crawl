<?php
    namespace App\Router;
    use App\Form\Logic as Logic;
    /**
     * header to form input
     */
    class Router{        
        public $logic;

        public function __construct(){
            $this->logic = new Logic();
        }

        public function action(){
            if(!$this->logic->checkForm()){
                return header("Location: /app/Form/form.php");
            }
            $this->logic->action();
        }
    }