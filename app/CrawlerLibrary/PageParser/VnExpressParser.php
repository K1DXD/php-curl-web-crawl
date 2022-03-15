<?php
    namespace App\CrawlerLibrary\PageParser;
    use App\CrawlerLibrary\Parser as Parser;
    
    /**
     * VnExpressParser
     * each method will return about string from $doc
     */
    class VnExpressParser extends Parser\Parser implements Parser\IParser {
        /**
         * @return string
         */
        public function getTitle(){
            $element = $this->doc->getElementsByTagName('h1');
            return utf8_decode($element[0]->nodeValue);
        }

        /**
         * @return string
         */
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

        /**
         * @return string
         */
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