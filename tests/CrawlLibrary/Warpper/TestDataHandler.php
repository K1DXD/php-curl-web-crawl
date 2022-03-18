<?php
    use PHPUnit\Framework\TestCase;
    use App\CrawlerLibrary\Warpper\DataHandler as DataHandler;
    use App\CrawlerLibrary\PageParser\DantriParser as DantriParser;

    class TestDataHandler extends TestCase
    {
        protected $dataHandler;

        protected function setUp():void 
        {
            $this->dataHandler = $this->getMockBuilder(DataHandler::class)
                                      ->setConstructorArgs([''])
                                      ->setMethods(['getParser'])
                                      ->getMock();
        }

        public function testCurlReturnInvalid()
        {   
            $this->dataHandler->parser = false;
            $this->assertEquals(false, $this->dataHandler->getData());
        }

        public function testCurlReturnValidPageParserReturnInvalid()
        {   
            $this->dataHandler->parser = $this->createMock(DantriParser::class);
            $this->assertEquals(false, $this->dataHandler->getData());
        }

        public function testCurlReturnvalidPageParserReturnValid()
        {
            $this->dataHandler->parser = $this->createMock(DantriParser::class);
            $this->dataHandler->parser->method('validateUrl')
                         ->willReturn(true);
            $demo = '{"title":null,"content":null,"date":null}';
            $this->assertEquals($demo, $this->dataHandler->getData());
        }
    }