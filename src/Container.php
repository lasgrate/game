<?php

namespace Game;

use InvalidArgumentException;

class Container
{
    protected $services;

    protected $factories;

    public function __construct(array $factories, array $config = [])
    {
        $this->services['config'] = $config;
        $this->factories = $factories;
    }

    public function has(string $serviceName): bool
    {
        return isset($this->services[$serviceName]) || isset($this->factories[$serviceName]);
    }

    /**
     * @param $serviceName
     * @return mixed
     */
    public function get(string $serviceName)
    {
        if (isset($this->services[$serviceName])) {
            return $this->services[$serviceName];
        }

        if (!$this->has($serviceName)) {
            throw new InvalidArgumentException("Unknown service: $serviceName");
        }

        $service = $this->create($serviceName);
        $this->services[$serviceName] = $service;

        return $service;
    }

    /**
     * @param $serviceName
     * @return mixed
     */
    public function create(string $serviceName)
    {
        $factory = $this->factories[$serviceName];
        $factory = new $factory();
        return $factory($this, $serviceName);
    }
}
