<?php 

declare(strict_types=1);

use App\Exceptions\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;

    //Метод который запускается перед тестами
    protected function setUp(): void
    {
        parent::setUp();

        $this->router = new Router();
    }
    //Проверка методов классаRouter
    public function testItRegistersRoute(): void
    {
        //Допускаем что есть экземпляр Router
        $router = new Router;
        //Который вызывает метод свой register()
        $router = $router->register('get', '/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index'],
            ]
        ];
        //И утверждаем что знчения из $router->routes() будут равны $expected
        $this->assertEquals($expected, $router->routes());
    }
    public function testItRegistersPostRoute(): void
    {

        $router = $this->router->post('/users', ['Users', 'index']);

        $expected = [
            'post' => [
                '/users' => ['Users', 'index'],
            ]
        ];

        $this->assertEquals($expected, $router->routes());
    }
    public function testItRegistersGetRoute(): void
    {
        $router = $this->router->get('/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index'],
            ]
        ];

        $this->assertEquals($expected, $router->routes());
    }

    public function testThereAreNoRoutesWhenRouterCreated(){
        $router = new Router();

        $this->assertEquals([], $router->routes());
    }
    //@test - позволяет называть метод без слова test,
    //@dataProvider routeNotFoundCases - позволяет использвать аргументы из метода routeNotFoundCases, которые он возвращает в виде маасива
    /**
     * @test
     * @dataProvider routeNotFoundCases
     */
    
    public function itThrowsRouteNotFoundException(string $requestUri,string $requestMethod){
        $user = new Class{
            public function delete(){
                return true;
            }
        };
        $this->router->get('/users', [$user::class, 'index']);
        $this->router->post('/users', ['User', 'store']);
        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }

    public static function routeNotFoundCases(){
        return [
            ['/test', 'get'],
            ['/users', 'put'],
            ['/users', 'post'],
            ['/users', 'get'],
        ];
    }

    public function testItResolveRouteFromClosure(){
        $this->router->get('/users', fn()=>[1,2,3]);

        $this->assertEquals([1,2,3], $this->router->resolve('/users', 'get'));
    }

    public function testItResolveRoute(){
        $user = new Class{
            public function index(){
                return [1,2,3];
            }
        };

        $this->router->get('/users', [$user::class, 'index']);

        $this->assertEquals([1,2,3], $this->router->resolve('/users', 'get'));
    }


}