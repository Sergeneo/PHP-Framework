<?php
if (!function_exists('get')) {
	function get(string $name) {
		return isset($_GET[$name]) ? trim($_GET[$name]) : null;
	}
}

if (!function_exists('post')) {
	function post(string $name) {
		return isset($_POST[$name]) ? trim($_POST[$name]) : null;
	}
}

if (!function_exists('cookie')) {
	function cookie(string $name, $value = '', int $expires = 0, $path = '/') {
		$value = trim($value);

		if ($expires == -1) return setcookie($name, '', 0, $path);

		if ($value) {
			return setcookie($name, $value, time() + 60 * 60 * 24 * $expires, $path);
		} else {
			return $_COOKIE[$name] ?? false;
		}
	}
}

if (!function_exists('session')) {
	function session(string $name, $value = '') {
		$value = trim($value);

		if ($value) {
			return $_SESSION[$name] = $value;
		} else {
			return $_SESSION[$name] ?? false;
		}
	}
}

if (!function_exists('json')) {
	function json(array $data = []) {
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}
}

if (!function_exists('view')) {
	function view(string $name, array $data = []) {
		require_once APP .'/Views/'. $name .'.php';
	}
}

if (!function_exists('redirect')) {
	function redirect($page = '/') {
		header('Location: '. $page);
		exit;
	}
}

if (!function_exists('protocol')) {
	function protocol() {
		if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
			return 'https://';
		} else {
			return 'http://';
		}
	}
}

if (!function_exists('json_validate')) {
	function json_validate($json, int $depth = 512, int $flags = 0) {
		if (!is_string($json)) {
			return false;
		}

		try {
			json_decode($json, false, $depth, $flags | JSON_THROW_ON_ERROR);
			return true;
		} catch (\JsonException $e) {
			return false;
		}
	}
}