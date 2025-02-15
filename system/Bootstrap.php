<?php
require_once SYSTEM .'/Helpers.php';

foreach (glob(APP .'/Helpers/*.php') as $file) {
	require_once $file;
}

require_once APP .'/Config/App.php';
require_once SYSTEM .'/DataBase.php';
require_once SYSTEM .'/Controller.php';
require_once APP .'/Controllers/BaseController.php';

class Bootstrap
{
	public $routes = [];
	public $route = '';

	public function route(string $from, string $to)
	{
		$from = str_ireplace('(:any)', '(.*?)', $from);
		$this->routes[$from] = $to;
	}

	public function run()
	{
		require_once APP .'/Config/Routes.php';

		$route = false;
		$path = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
		$path = preg_replace("#\/index$#i", '', $path);

		foreach ($this->routes as $from => $to) {
			if ($route) continue;
			$from = trim($from, '/');
			$from = preg_replace("#\/index$#i", '', $from);

			if ($from === '(.*?)' and $path === '') continue;
			if (!preg_match("~^{$from}$~i", $path, $matches)) continue;

			foreach ($matches as $key => $value) {
				if (!$key) continue;
				$to = str_ireplace("\${$key}", $value, $to);
			}

			$to = explode('/', trim($to, '/'));
			$dir = '';
			$file = '';
			$method = '';
			$params = [];

			foreach ($to as $value) {
				if ($file) {
					if ($method) {
						$params[] = $value;
					} else {
						$method = $value;
					}
				} else {
					if (is_file(APP .'/Controllers/'. $dir . $value .'.php')) {
						$file = $value;
						$this->route = $from;

						require_once APP .'/Controllers/'. $dir . $file .'.php';
					} elseif (is_dir(APP .'/Controllers/'. $dir . $value)) {
						$dir = $value .'/';
					}
				}
			}

			if ($file) {
				$controller = new $file();

				if ($method) {
					if (method_exists($controller, $method)) {
						if (!empty($params)) {
							$controller->$method(...$params);
						} else {
							$controller->$method();
						}

						$route = true;
					}
				} elseif (method_exists($controller, 'index')) {
					$controller->index();
					$route = true;
				}
			}
		}

		if (!$route) {
			$controller = new BaseController();
			$controller->error(404);
		}
	}
}