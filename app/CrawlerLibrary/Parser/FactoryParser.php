<?php
    namespace App\CrawlerLibrary\Parser;
    use App\CrawlerLibrary\PageParser as PageParser;
    /**
     *  reconize the url
     *  @return about PageParser class
     */
    class FactoryParser{
        const PAT = '/^\w+\:..(\w+)/';
        /** @var string*/
        private $url;
        /** @var DOMDocument */
        private $doc;
        
        /**
         * @param $url string
         * @param $doc string
         */
        public function __construct($url, $doc){
            $this->url = $url;
            $this->doc = $doc;
        }

        /**
         * @return boolean or call caseLogic()
         */
        function factoryParser(){
            if(preg_match(self::PAT, $this->url, $match) && $this->doc){
                return $this->caseLogic($match[0]);
            }else {
                return false;
            }
        }

        /**
         * @param $data string
         * @return about PageParser or boolean false
         */
        private function caseLogic($data){
            switch ($data){
                case Parser::VIETNAMNET :
                    return new PageParser\DantriParser($this->doc, $this->url);
                case Parser::DANTRI :
                    return new PageParser\VietNamNetParser($this->doc, $this->url);
                case Parser::VNEXPRESS :
                    return new PageParser\VnExpressParser($this->doc, $this->url);
                default:
                    return false;
            }
        }
    }