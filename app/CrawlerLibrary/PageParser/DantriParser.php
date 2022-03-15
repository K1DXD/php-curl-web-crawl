<?php
    namespace App\CrawlerLibrary\PageParser;
    use App\CrawlerLibrary\Parser as Parser;
    
    /**
     * DantriParser
     * each method will return about string from $doc
     */
    class DantriParser extends Parser\Parser implements Parser\IParser {
        /**
         * @return string
         */
        public function getTitle(){
            $title = $this->doc->getElementsByTagName('h1');
            return $title[0]->nodeValue;            
        }

        /**
         * @return string
         */
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

        /**
         * @return string
         */
        public function getDate(){
            $date = $this->doc->getElementsByTagName('time');
            return $date[0]->nodeValue;
        }

    }