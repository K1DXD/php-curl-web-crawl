<?php
    interface IParser {
        public function getTitle();
        public function getContent();
        public function getDate();
    }

    class Parser {
        protected $doc;
        public const VIETNAMNET = 'https://dantri';
        public const DANTRI = 'https://vietnamnet';
        public const VNEXPRESS = 'https://vnexpress';
        
        public function __construct($doc){
            $this->doc = $doc;
        }

        public function validateUrl(){
            $title = $this->doc->getElementsBytagName('h1');
            return strlen($title[0]->nodeValue) > 4 ?  true : false;
        }
    }

    class FactoryParser{
        const PAT = '/^\w+\:..(\w+)/';
        private $url;
        private $doc;

        public function __construct($url, $doc){
            $this->url = $url;
            $this->doc = $doc;
        }

        function factoryParser(){
            if(preg_match(self::PAT, $this->url, $match)){
                return $this->caseLogic($match[0]);
            }
        }

        private function caseLogic($data){
            switch ($data){
                case Parser::VIETNAMNET :
                    return new DantriParser($this->doc, $this->url);
                case Parser::DANTRI :
                    return new VietNamNetParser($this->doc, $this->url);
                case Parser::VNEXPRESS :
                    return new VnExpressParser($this->doc, $this->url);
                default:
                    return false;
            }
        }
    }
