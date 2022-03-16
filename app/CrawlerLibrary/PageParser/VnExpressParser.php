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
            $pat1 = '<h1 class="title-detail">';
            $pat2 = '</h1>';
            return $this->getData($pat1, $pat2);   
        }

        /**
         * @return string
         */
        public function getContent(){
            $pat1 = '<p class="Normal">';
            $pat2 = '</p>';
            return $this->getData($pat1, $pat2);  
        }

        /**
         * @return string
         */
        public function getDate(){
            $pat1 = '<span class="date">';
            $pat2 = '</span>';
            return $this->getData($pat1, $pat2);  
        }

    }