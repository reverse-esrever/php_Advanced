<?php

namespace Tests\Unit;

use App\Container;
use App\Exceptions\ContainerException;
use App\Services\GatewayPaymentService;
use App\Services\GatewayPaymentServiceInterface;
use App\Services\InvoiceService;
use PHPUnit\Framework\TestCase;
use Tests\TestClasses\AbstractClass;
use Tests\TestClasses\ClassWithBuiltInTypeParam;
use Tests\TestClasses\ClassWithNoTypeHintParam;
use Tests\TestClasses\ClassWithUnionTypeParam;

class ContainerTest extends TestCase
{
    private Container $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container();
    }

    public function testItSetBindigs()
    {

        $class = new class {};
        $class2 = new class {};

        $this->container->set($class::class, $class2::class);

        $expected = $class2;
        $actual = $this->container->get($class::class);

        $this->assertEquals($expected, $actual);
    }
    public function testItGetClassWhenCallableBindigs()
    {

        $class = new class {};

        $this->container->set($class::class, function () use ($class) {
            return $class;
        });

        $expected = $class;
        $actual = $this->container->get($class::class);

        $this->assertEquals($expected, $actual);
    }

    public function testItResolvesClassFromContainer()
    {
        $class = new class {};

        $result = $this->container->resolve($class::class);

        $this->assertEquals($class, $result);
    }
    public function testItResolvesWhenCantGetClassFromContainer()
    {
        $class = new class {};

        $result = $this->container->get($class::class);

        $this->assertEquals($class, $result);
    }
    public function testItThrowExceptionForAbstaract()
    {
        $this->expectException(ContainerException::class);
        $message = "Class " .  AbstractClass::class . " is not Instantiable";
        $this->expectExceptionMessage($message);

        $this->container->get(AbstractClass::class);
    }
    public function testItCreatesClassWithoutConstructorOrParams()
    {

        $class = new class {
            public function __construct() {}
        };

        $actual = $this->container->get($class::class);

        $this->assertEquals($class, $actual);
    }
    public function testItThrowExceptionForNotTypeHintedParams()
    {
        $this->expectException(ContainerException::class);

        $this->container->get(ClassWithNoTypeHintParam::class);
    }
    public function testItThrowExceptionForUnionTypeHintedParams()
    {
        $this->expectException(ContainerException::class);

        $this->container->get(ClassWithUnionTypeParam::class);
    }
    public function testItThrowExceptionForBuiltInTypeHintedParams()
    {
        $this->expectException(ContainerException::class);

        $this->container->get(ClassWithBuiltInTypeParam::class);
    }
    public function testItResolveClassWithDependecies()
    {
        $this->container->set(GatewayPaymentServiceInterface::class, GatewayPaymentService::class);

        $actual = $this->container->get(InvoiceService::class);

        $this->assertIsObject($actual);
    }
}
