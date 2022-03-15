<?php
    namespace App\CrawlerLibrary\Parser;
    /**
     * interface for PageParser class
     */
    interface IParser {
        public function getTitle();
        public function getContent();
        public function getDate();
    }