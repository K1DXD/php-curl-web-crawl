<?php
    class DataHandler {
        private $parser;
        private $url;

        public function __construct($url){
            $this->url = $url;
            $doc = new CurlWrapper($this->url);
            $factory = new FactoryParser($this->url, $doc->wrapData());
            $this->parser = $factory->factoryParser();
        }

        public function getData(){
            if($this->parser && $this->parser->validateUrl()){
                return json_encode(
                    array(
                        "title" => $this->parser->getTitle(),
                        "content" => $this->parser->getContent(),
                        "date" => $this->parser->getDate()
                    )
                );
            }else {
                echo 'Invalid url!!!';
                return false;
            }
        }

    }

    class CurlWrapper{
        private $url;

        function __construct($url){
            $this->url = $url;
        }

        function wrapData(){
            $doc = new DOMDocument();
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($curl);
            curl_close($curl);
            $doc->loadHTML($data);
            return $doc;
        }
    }