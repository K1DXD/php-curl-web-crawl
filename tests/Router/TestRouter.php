<?php
use PHPUnit\Framework\TestCase;
use App\Form\Logic as Logic;
use App\Router\Router as Router;

class TestRouter extends TestCase
{   
    protected $logic;
    protected $router;
    protected $dataHandler;
    protected $addData;

    protected function setUp():void
    {   
        $this->logic = $this->createMock(Logic::class);
        $this->router = $this->getMockBuilder(Router::class)
                             ->setConstructorArgs([$this->logic])
                             ->setMethods(['execute'])
                             ->getMock();
    }

    /**
     * @runInSeparateProcess
     */
    public function testRouterActionIsFalse()
    {
        $this->logic->method('checkForm')
              ->willReturn(false);
        $this->assertEquals(null, $this->router->action());
    }

    public function testRouterActionIsTrue()
    {
        $this->logic->method('checkForm')
              ->willReturn(true);
        $this->assertEquals(null, $this->router->action());
    }
} 