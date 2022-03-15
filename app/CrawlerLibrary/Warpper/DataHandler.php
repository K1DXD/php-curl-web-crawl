<?php
    namespace App\CrawlerLibrary\Warpper;
    use App\CrawlerLibrary\Parser\FactoryParser as FactoryParser;
    use App\CrawlerLibrary\Warpper\CurlWrapper as CurlWrapper;

    class DataHandler {
        private $parser;
        private $url;

        public function __construct($url){
            $this->url = $url;
            $this->parser = $this->getParser();
        }

        private function getParser(){
            $doc = new CurlWrapper($this->url);
            $doc = $doc->wrapData();
            if($doc){
                $factory = new FactoryParser($this->url, $doc);
                return $factory->factoryParser();
            }else {
                return false;
            }
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
                return false;
            }
        }

    }