<?php
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