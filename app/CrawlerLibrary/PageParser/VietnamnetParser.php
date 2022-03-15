<?php
    namespace App\CrawlerLibrary\PageParser;
    use App\CrawlerLibrary\Parser as Parser;
    
    /**
     * VietNamNetParser
     * each method will return about string from $doc
     */
    class VietNamNetParser extends Parser\Parser implements Parser\IParser {
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

        /**
         * @return string
         */
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