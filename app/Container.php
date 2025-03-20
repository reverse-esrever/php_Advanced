<?php

namespace App;

use App\Exceptions\ContainerException;
use App\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {

        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if(is_callable($entry)){
                return $entry($this);
            }

            $id = $entry;
        }
        return $this->resolve($id);
    }
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        $reflector = new \ReflectionClass($id);

        if (!$reflector->isInstantiable()) {
            throw new ContainerException("Class $id is not Instantiable");
        }

        $constructor = $reflector->getConstructor();
        if (! $constructor) {
            return new $id;
        }

        $params = $constructor->getParameters();

        if (! $params) {
            return new $id;
        }

        $dependecies = array_map(function (\ReflectionParameter $param) use ($id) {
            $name = $param->getName();
            $type = $param->getType();

            if (! $type) {
                throw new ContainerException(
                    'Failed to resolve class ' . $id . "because  param" . $name . " is missing type hint"
                );
            }

            if ($type instanceof \ReflectionUnionType) {
                throw new ContainerException(
                    'Failed to resolve class ' . $id . "because  param" . $name . " has union type"
                );
            }
            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }
            throw new ContainerException("Failed to resolve Class $id because invalid param $name");
        }, $params);

        return $reflector->newInstanceArgs($dependecies);
    }
}
