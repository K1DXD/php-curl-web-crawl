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
         * @return DOMDocument or boolean
         */
        function wrapData(){
            if(filter_var($this->url, FILTER_VALIDATE_URL)){
                $doc = new \DOMDocument();
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $this->url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $data = curl_exec($curl);
                curl_close($curl);
                $doc->loadHTML($data);
                return $doc;
            }else {
                return false;
            }
        }
    }