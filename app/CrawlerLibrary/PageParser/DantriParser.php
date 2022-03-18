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
            $pat1 = '<h1 class="title-page detail">';
            $pat2 = '</h1>';
            return $this->getData($pat1, $pat2);     
        }

        /**
         * @return string
         */
        public function getContent(){
            $pat1 = '<p>';
            $pat2 = '</p>';
            return $this->getData($pat1, $pat2);  
        }

        /**
         * @return string
         */
        public function getDate(){
            $pat1 = '<time class="author-time" datetime="';
            $pat2 = '">';
            return $this->getData($pat1, $pat2);  
        }

    }