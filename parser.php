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

    class DantriParser extends Parser implements IParser {
        public function getTitle(){
            $title = $this->doc->getElementsByTagName('h1');
            return $title[0]->nodeValue;            
        }

        public function getContent(){
            $elements = $this->doc->getElementsByTagName('p');
            $content;
            foreach($elements as $element){
                if($element->parentNode->nodeName == 'div'){
                    $content .= $element->nodeValue;
                    $content .= '<br>';
                }
            }
            return $content;
        }

        public function getDate(){
            $date = $this->doc->getElementsByTagName('time');
            return $date[0]->nodeValue;
        }

    }

    class VietNamNetParser extends Parser implements IParser {
        public function getTitle(){
            $title = $this->doc->getElementsByTagName('h1');
            return $title[0]->nodeValue;            
        }

        public function getContent(){
            $content;
            $elements = $this->doc->getElementsByTagName('p');
            foreach($elements as $element){
                if($element->parentNode->getAttribute('id') == 'ArticleContent'){
                    $content .= $element->nodeValue;
                    $content .= '<br>';
                }
            }
            return $content;
        }

        public function getDate(){
            $date;
            $elements = $this->doc->getElementsByTagName('span');
            foreach($elements as $element){
	            if($element->getAttribute('class') == 'ArticleDate'){
		            $date .= $element->nodeValue;
	            }
            }
            return $date;
        }

    }

    class VnExpressParser extends Parser implements IParser {
        public function getTitle(){
            $element = $this->doc->getElementsByTagName('h1');
            return utf8_decode($element[0]->nodeValue);
        }

        public function getContent(){
            $content;
            $elements = $this->doc->getElementsByTagName('p');
            foreach($elements as $element){
                if($element->getAttribute('class') == 'Normal'){
                    $content .= utf8_decode($element->nodeValue);
                    $content .= '<br>';
                }
            }
            return $content;
        }

        public function getDate(){
            $date;
            $elements = $this->doc->getElementsByTagName('span');
            foreach($elements as $element){
	            if($element->getAttribute('class') == 'date'){
		            $date .= utf8_decode($element->nodeValue);
	            }
            }
            return $date;
        }

    }