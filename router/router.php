<?php
    class Router{
        public $logic;

        public function __construct(){
            $this->logic = new Logic();
        }

        public function action(){
            $this->logic->action();
        }
    }