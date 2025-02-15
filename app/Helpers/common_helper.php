<?php
if (!in_array('openssl', get_loaded_extensions())) {
	exit('Error: Extension "openssl" not loaded!');
}

if (!function_exists('decrypt_key')) {
	function decrypt_key($value, string $master_key) {
		if (!$value) return '';
		return openssl_decrypt($value, 'aes-256-cbc', $master_key, 0, 'mkey-aes-256-cbc');
	}
}

if (!function_exists('encrypt_key')) {
	function encrypt_key($value, string $master_key) {
		if (!$value) return '';
		return openssl_encrypt($value, 'aes-256-cbc', $master_key, 0, 'mkey-aes-256-cbc');
	}
}