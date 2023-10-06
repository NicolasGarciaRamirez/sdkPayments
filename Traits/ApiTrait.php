<?php

class ApiTrait {

	public function callApi($endpoint, $method = 'GET', $data = []) 
	{
        $url = $this->base_url . $endpoint;

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->api_key,
        ];

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