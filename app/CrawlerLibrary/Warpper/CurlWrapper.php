<?php
    namespace App\CrawlerLibrary\Warpper;
    /**
     * parse data from url
     */
    class CurlWrapper{
        private $url;
        function __construct($url){
            $this->url = $url;
        }

        /**
         * @return string or boolean
         */
        function wrapData(){
            if(filter_var($this->url, FILTER_VALIDATE_URL)){
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $this->url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $doc = curl_exec($curl);
                curl_close($curl);
                return $doc;
            }else {
                return false;
            }
        }
    }