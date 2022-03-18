<?php
    namespace App\CrawlerLibrary\Warpper;
    /**
     * parse data from url
     */
    class CurlWrapper{
        public $url;
        function __construct($url){
            $this->url = $url;
        }

        /**
         * @return string or boolean
         */
        public function wrapData()
        {
            if(filter_var($this->url, FILTER_VALIDATE_URL)){
                return $this->curl();
            }else {
                return false;
            }
        }

        protected function curl()
        {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $doc = curl_exec($curl);
            curl_close($curl);
            return $doc;
        }
    }