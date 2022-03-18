<?php
    use PHPUnit\Framework\TestCase;
    use App\CrawlerLibrary\Parser\FactoryParser as FactoryParser;

    class TestFactoryParser extends TestCase
    {
        protected $factory;
        protected $doc;
        protected $url;

        protected function setUp():void 
        {   
            $this->factory = $this->getMockBuilder(FactoryParser::class)
                                  ->setConstructorArgs(['',''])
                                  ->getMock();
                                  

        }

        public function testIfDocIsFalse()
        {   
            $this->url = '';
            $this->doc = false;
            $this->factory = new FactoryParser($this->url, $this->doc);
            $this->assertEquals(false, $this->factory->factoryParser($this->url));
        }

        public function testIfDocIsTrue()
        {   
            $this->url = 'https:\\dantri.com';
            $this->doc = true;
            $this->factory->method('caseLogic')
                          ->willReturn(false);
            $this->factory = new FactoryParser($this->url, $this->doc);
            $this->assertEquals(false, $this->factory->factoryParser());
        }
    }