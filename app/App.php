<?php

namespace Resume;

use Resume\Router;
use Resume\Container\Container;
use Resume\Helpers\Config;

class App
{
	protected $router;
	public $container;

	public function __construct(Container $container)
	{
		$this->container = $container;
		$this->route = $container->get(Router::class);
	}

	public function run()
	{
		$this->route->process();
	}

    public function any($pattern, $callable)
    {
        $this->map(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'], $pattern, $callable);
    }

	public function get($pattern, $callable)
	{
		$this->map(['GET'], $pattern, $callable);
	}

 	public function post($pattern, $callable)
    {
        $this->map(['POST'], $pattern, $callable);
    }

    public function put($pattern, $callable)
    {
        $this->map(['PUT'], $pattern, $callable);
    }

 	public function patch($pattern, $callable)
    {
        $this->map(['PATCH'], $pattern, $callable);
    }

    public function delete($pattern, $callable)
    {
        $this->map(['DELETE'], $pattern, $callable);
    }

    public function set404($callable)
    {
        $this->route->notFound = $callable;
    }

    /**
     * Shorthand for a route accessed using OPTIONS
     *
     * @param string $pattern A route pattern such as /about/system
     * @param object|callable $fn The handling function to be executed
     */
    public function options($pattern, $callable)
    {
        $this->map(['OPTIONS'], $pattern, $callable);
    }

	public function map(array $methods, $pattern, $callable)
	{
		$this->route->match($methods, $pattern, $callable);
	}

    public function setUpConfig($path)
    {
        Config::setUp($path);
    }
}