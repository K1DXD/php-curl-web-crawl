<?php
    use PHPUnit\Framework\TestCase;
    use App\Form\Logic as Logic;

    class TestLogic extends TestCase
    {   
        protected $logic;

        protected function setUp():void
        {
            $this->logic = $this->getMockBuilder(Logic::class)
                                ->setMethods(['getParser','addData'])
                                ->getMock();
        }

        public function testCheckFormIfDataIsSet()
        {
            $this->logic->data = array(
                'url' => ' ',
                'username' => ' ',
                'password' => ' '
            );
            $this->assertEquals(true, $this->logic->checkForm());
        }

        public function testCheckFormIfDataIsNotSet()
        {
            $this->assertEquals(false, $this->logic->checkForm());
        }

        public function testActionIfGetValidUrl()
        {   
            $this->logic->expects($this->once())
                        ->method('getParser')
                        ->willreturn(true);
            $this->logic->expects($this->once())
                        ->method('addData')
                        ->willreturn(true);
            $this->assertTrue($this->logic->action());
        }

        public function testActionIfGetInvalidUrl()
        {   
            $this->logic->expects($this->once())
                        ->method('getParser')
                        ->willreturn(false);
            $this->assertFalse($this->logic->action());
        }
    }