<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Services\EmailService;
use App\Services\GatewayPaymentService;
use App\Services\GatewayPaymentServiceInterface;
use App\Services\InvoiceService;
use App\Services\SaleTaxService;

class App
{
    private static DB $db;

    public function __construct(protected Container $container,protected Router $router, protected array $request, protected Config $config)
    {
        static::$db = new DB($config->db ?? []);
        $this->container->set(GatewayPaymentServiceInterface::class, GatewayPaymentService::class);
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (RouteNotFoundException) {
            http_response_code(404);

            echo View::make('error/404');
        }
    }
}
