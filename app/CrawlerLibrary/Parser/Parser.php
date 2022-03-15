<?php
    namespace App\CrawlerLibrary\Parser;
    /**
     * parent class for PageParser class
     */
    class Parser {
        
        /** @var DOMDocument $doc */
        protected $doc;
        public const VIETNAMNET = 'https://dantri';
        public const DANTRI = 'https://vietnamnet';
        public const VNEXPRESS = 'https://vnexpress';
        
        /** 
         * @param $doc DOMDocument
         */
        public function __construct($doc){
            $this->doc = $doc;
        }

        /**
         * @return boolean
         */
        public function validateUrl(){
            $title = $this->doc->getElementsBytagName('h1');
            return strlen($title[0]->nodeValue) > 4 ?  true : false;
        }
    }