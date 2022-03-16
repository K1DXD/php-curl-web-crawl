<?php
    namespace App\CrawlerLibrary\Parser;
    /**
     * parent class for PageParser class
     */
    class Parser {
        
        /** @var string $doc */
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
            if($this->getTitle()){
                return true;
            }else {
                return false;
            }
        }

        /**
         * @param $pat1 string
         * @param $pat2 string
         * @return string or boolean
         */
        protected function getData($pat1, $pat2){
            $htmlSelector = array();
            $start = 0;
            $offset = 0;
            $end = 0;
            $lenght = 0;
            $data = '';
            /**
             * get position of data story in $htmlSelector
             */
            while($start = stripos($this->doc, $pat1, $offset)){
                $end = strpos($this->doc, $pat2, $offset = $start);
                $start = $start + strlen($pat1);
                $lenght = $end - $start;
                $htmlSelector[] = array(
                    "start" => $start,
                    "lenght" => $lenght
                );
                $offset = $start + 1;
            }

            /**
             * get data
             */
            foreach($htmlSelector as $html){
                $data .= substr($this->doc, $html['start'], $html['lenght']);
                // $data .= $pat3;
            }
            return strlen($data) == 0 ? false : $data;
        }
    }