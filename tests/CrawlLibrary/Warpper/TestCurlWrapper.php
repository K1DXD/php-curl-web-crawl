<?php
    use PHPUnit\Framework\TestCase;
    use App\CrawlerLibrary\Warpper\CurlWrapper as CurlWrapper;

    class TestCurlWrapper extends TestCase
    {
        protected $curl;

        protected function setUp():void 
        {
            $this->curl = $this->getMockBuilder(CurlWrapper::class)
                               ->setConstructorArgs([''])
                               ->setMethods(['curl'])
                               ->getMock();
        }

        public function testWrapIfRightUrl()
        {
            $this->curl->url = 'https://dantri.com.vn/';
            $this->curl->method('curl')
                       ->willReturn(null);
            $this->assertEquals(null, $this->curl->wrapData());
        }

        public function testWrapIfUrlDontHaveProtocol()
        {
            $this->curl->url = 'dantri.com.vn/';
            $this->assertEquals(false, $this->curl->wrapData());
        }

        public function testWrapIfUrlEmptyString()
        {
            $this->curl->url = '';
            $this->assertEquals(false, $this->curl->wrapData());
        }

        public function testWrapIfUrlRandomString()
        {
            $this->curl->url = 'skfskhhksha';
            $this->assertEquals(false, $this->curl->wrapData());
        }
    }