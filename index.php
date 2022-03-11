<?php
    
    interface IParser {
        public function getTitle();
        public function getContent();
        public function getDate();

    }

    class Parser {
        protected $doc;

        public function __construct($doc){
            $this->doc = $doc;
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

    class DataHandler {
        private $parser;

        public function __construct(CurlWrapper $doc){
            $this->parser = new VnExpressParser($doc->wrapData());
        }

        public function getData(){
            return json_encode(
                array(
                    "title" => $this->parser->getTitle(),
                    "content" => $this->parser->getContent(),
                    "date" => $this->parser->getDate()
                )
            );
        }


    }

    class CurlWrapper{
        private $url;

        function __construct($url){
            $this->url = $url;
        }

        function wrapData(){
            $doc = new DOMDocument();
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($curl);
            curl_close($curl);
            $doc->loadHTML($data);
            return $doc;
        }
    }

    $url = 'https://vnexpress.net/omicron-tang-hinh-co-lan-tranh-test-nhanh-4436735.html';
    $pat = '/^\w+\:..(\w+)/';
    if(preg_match($pat, $url, $match)){
        echo $match[0];
    }
    // $demo = new DataHandler(new CurlWrapper($url));
    // $string = $demo->getData();
    // $string = json_decode($string);
    // var_dump($string);