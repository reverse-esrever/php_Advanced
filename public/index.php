<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Container;
use App\Controllers\GeneratorController;
use App\Controllers\HomeController;
use App\Contrvariance\AnimalFood;
use App\Contrvariance\Food;
use App\Covariance\CatShelter;
use App\Covariance\DogShelter;
use App\Examples\Attributes\Config as AttributesConfig;
use App\Examples\Attributes\ConfigBuilder;
use App\Router;
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$container = new Container();
$router = new Router($container);

$router->get('/', function () {
    return 'hello';
});
$router->get('/covariance', function () {
    $kitty = (new CatShelter())->adopt("Рыжик");
    $kitty->speak();
    echo "\n";

    $doggy = (new DogShelter())->adopt("Бобик");
    $doggy->speak();


    $kitty = (new CatShelter())->adopt("Рыжик");
    $catFood = new AnimalFood();
    $kitty->eat($catFood);
    echo "\n";

    $doggy = (new DogShelter())->adopt("Бобик");
    $banana = new Food();
    $doggy->eat($banana);
});


$builder = new ConfigBuilder();
$config = new AttributesConfig();
$builder->execute($config);
die;

(new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();
