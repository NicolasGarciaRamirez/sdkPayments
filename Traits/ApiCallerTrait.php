<?php
namespace Traits;

trait ApiCallerTrait {

	private $api_key;
    private $base_url = env('API_URL');

	public function __construct($api_key) {
        $this->api_key = $api_key;
        $this->base_url = env('API_URL');
    }
	public function callApi($endpoint, $method = 'GET', $data = [], $requiresAuth = false) {
		$url = $this->base_url . $endpoint;
	
		$headers = [
			'Content-Type: application/json',
		];
	
		if ($requiresAuth) {
			$headers[] = 'Authorization: Bearer ' . $this->api_key;
		}
	
		$options = [
			'http' => [
				'method' => $method,
				'header' => implode("\r\n", $headers),
				'content' => json_encode($data),
			],
		];
	
		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);
	
		if ($response === false) {
			// Manejo de errores de conexión
			return false;
		}
	
		return json_decode($response, true);
	}
}