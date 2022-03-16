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
            $pat1 = '<h1 class="title f-22 c-3e">';
            $pat2 = '</h1>';
            return $this->getData($pat1, $pat2);             
        }

        /**
         * @return string
         */
        public function getContent(){
            $pat1 = '<p class="t-j">';
            $pat2 = '</p>';
            return $this->getData($pat1, $pat2); 
        }

        /**
         * @return string
         */
        public function getDate(){
            $pat1 = '<span class="ArticleDate">';
            $pat2 = '</span>';
            return $this->getData($pat1, $pat2); 
        }

    }