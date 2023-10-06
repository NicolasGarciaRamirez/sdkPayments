<?php
use './Traits/ApiTrait';

class Main {

	use ApiTrait;.

    private $api_key;
    private $base_url = env('API_URL');

    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    public function authenticate($username, $password) {
        $data = [
            'username' => $username,
            'password' => $password,
        ];

        $response = $this->callApi('login', 'POST', $data);

        // Verifica si la solicitud fue exitosa y obtén el token
        if ($response && isset($response['api_token'])) {
            $api_token = $response['api_token'];
            return $api_token;
        } else {
            // Manejo de errores
            return false;
        }
    }
}