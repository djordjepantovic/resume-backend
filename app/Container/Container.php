<?php

namespace Resume\Container;

use Resume\Container\Exception\ServiceNotFoundException;
use Resume\Container\Exception\ParameterNotFoundException;
use Resume\Container\Exception\ContainerException;
use Resume\Container\Reference\ParameterReference;
use Resume\Container\Reference\ServiceReference;

/**
 * A very simple dependency injection container.
 */
class Container
{
	/**
     * @var array
     */
	private $services;
	
	/**
     * @var array
     */
	private $parameters;
	
	/**
     * @var array
     */
	private $serviceStore;

	/**
	 * @param array $services   The service definitions.
	 * @param array $parameters The parameter definitions.
	 */
	public function __construct(array $services = [], array $parameters = [])
	{
		$this->services 	= $services;
		$this->parameters   = $parameters;
		$this->serviceStore = [];
	}

	public function get($name)
	{
		if (!$this->has($name)) {
			throw new ServiceNotFoundException('Service not found: '. $name);
		}

		// If we haven't created it, create it and save to store
		if (!isset($this->serviceStore[$name])) {
			$this->serviceStore[$name] = $this->createService($name);
		}

		// Return service from store
		return $this->serviceStore[$name];
	}

	public function has($name)
	{
		return isset($this->services[$name]);
	}

	public function getParameter($name)
	{
		$tokens = explode('.', $name);
		$context = $this->parameters;

		while (null !== ($token = array_shift($tokens))) {
			if (!isset($context[$token])) {
				throw new ParameterNotFoundException('Parameter not found: '. $name);
			}

			$context = $context[$token];
		}

		return $context;
	}

	public function hasParameter($name)
	{
		try {
			$this->getParameter($name);
		} catch (ParameterNotFoundException $exception) {
			return false;
		}

		return true;
	}

	/**
	 * Attempt to create a service
	 * 
	 * @param  string $name The service name.
	 * @return mixed The created service.
	 * @throws  ContainerException on faliure.
	 */
	private function createService($name)
	{
		$entry = &$this->services[$name];

		if (!is_array($entry) || !isset($entry['class'])) {
			throw new ContainerException($name .' service entry must be an array containing a \'class\' key');
		}
		elseif (!class_exists($entry['class'])) {
			throw new ContainerException($name .' service class does not exist: '. $entry['class']);
		}
		elseif (isset($entry['lock'])) {
			throw new ContainerException($name .' service contains a circular reference');
			
		}

		$entry['lock'] = true;

		$arguments = isset($entry['arguments']) ? $this->resolveArguments($entry['arguments']) : [];

		$reflector = new \ReflectionClass($entry['class']);
		$service = $reflector->newInstanceArgs($arguments);

		if (isset($entry['calls'])) {
			$this->initService($service, $name, $entry['calls']);
		}

		return $service;
	}

	/**
     * Resolve argument definitions into an array of arguments.
     *
     * @param array  $argumentDefinitions The service arguments definition.
     * @return array The service constructor arguments.
     * @throws ContainerException on failure.
     */
	private function resolveArguments(array $argumentDefinitions)
	{
		$arguments = [];

		foreach ($argumentDefinitions as $argumentDefinition) {
			if ($argumentDefinition instanceof ServiceReference) {
				$argumentServiceName = $argumentDefinition->getName();

				$arguments[] = $this->get($argumentServiceName);
			}
			elseif ($argumentDefinition instanceof ParameterReference) {
				$argumentParameterName = $argumentDefinition->getName();

				$arguments[] = $this->getParameter($argumentParameterName);
			}
			else {
				$arguments[] = $argumentDefinition;
			}
		}

		return $arguments;
	}

 	/**
     * Initialize a service using the call definitions.
     *
     * @param object $service         The service.
     * @param string $name            The service name.
     * @param array  $callDefinitions The service calls definition.
     *
     * @throws ContainerException on failure.
     */
	private function initService($service, $name, array $callDefinitions)
	{
		foreach ($callDefinitions as $callDefinition) {
			if (!is_array($callDefinition) || !isset($callDefinition['method'])) {
				throw new ContainerException($name .' service calls must be arrays containing a \'method\' key');
			}
			elseif (!is_callable([$service, $callDefinition['method']])) {
				throw new ContainerException($name .' service asks for call to uncallable method: '. $callDefinition['method']);
			}

			$arguments = isset($callDefinition['arguments']) ? $this->resolveArguments($callDefinition['arguments']) : [];

			call_user_func_array([$service, $callDefinition['method']], $arguments);
		}
	}
}