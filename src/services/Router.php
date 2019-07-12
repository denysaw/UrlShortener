<?php
/**
 * @author Denysaw
 */
declare(strict_types=1);

namespace App\Services;

/**
 * Class Router
 * @package App\Services
 */
class Router
{

	/**
	 * @var array
	 */
	protected $routes = [];


	/**
	 * @param string $url
	 * @param string $action
	 */
	public function add(string $url, string $action)
	{
		$this->routes[] = (object) ['url' => $url, 'action' => $action];
	}


	/**
	 * @param string $url
	 * @throws \ReflectionException
	 */
	public function handle(string $url)
	{
		foreach ($this->routes as $route) {
			if (preg_match('~^'. $route->url. '$~', $url)) {
				@list($controller, $action) = explode('/', $route->action);
				break;
			}
		}

		if (!isset($controller)) {
			$controller = 'front';
			$action = 'findUrl';
			$_POST['url'] = trim($url, '/');
		}

		if (!isset($action)) $action = 'index';

		$controller = 'App\\Controllers\\'. ucfirst($controller). 'Controller';
		$controller = $this->instantiate($controller);

		$controller->{$action. 'Action'}(...array_values($_POST));
	}


	/**
	 * @param string $class
	 * @return mixed
	 * @throws \ReflectionException
	 */
	protected function instantiate(string $class)
	{
		$args = [];

		if (method_exists($class, '__construct')) {
			$reflection = new \ReflectionMethod($class, '__construct');

			foreach ($reflection->getParameters() as $param) {
				$dependency = (string) $param->getType();
				if (!trim($dependency)) continue;

				$args[] = $this->instantiate($dependency);
			}
		}

		return new $class(...$args);
	}
}