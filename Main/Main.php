<?php
namespace Main;

use Traits\ApiCallerTrait;
// RUTAS DE LA API NICOPAY PARA CREAR PLANES Y SUBSCRIPCIONES
// GET|HEAD        api/Cards ............................................................................ cardsIndex › Cards\CreditCardController@index  
//   POST            api/Cards/save ......................................................................... cardsSave › Cards\CreditCardController@save  
//   GET|HEAD        api/Plans .................................................................................. Plans.index › Plan\PlanController@index  
//   POST            api/Plans .................................................................................. Plans.store › Plan\PlanController@store  
//   GET|HEAD        api/Plans/create ......................................................................... Plans.create › Plan\PlanController@create  
//   GET|HEAD        api/Plans/{Plan} ............................................................................. Plans.show › Plan\PlanController@show  
//   PUT|PATCH       api/Plans/{Plan} ......................................................................... Plans.update › Plan\PlanController@update  
//   DELETE          api/Plans/{Plan} ....................................................................... Plans.destroy › Plan\PlanController@destroy  
//   GET|HEAD        api/Plans/{Plan}/edit ........................................................................ Plans.edit › Plan\PlanController@edit  
//   GET|HEAD        api/Subscriptions .................................................. Subscriptions.index › Subscription\SubscriptionController@index  
//   POST            api/Subscriptions .................................................. Subscriptions.store › Subscription\SubscriptionController@store  
//   GET|HEAD        api/Subscriptions/create ......................................... Subscriptions.create › Subscription\SubscriptionController@create  
//   GET|HEAD        api/Subscriptions/{Subscription} ..................................... Subscriptions.show › Subscription\SubscriptionController@show  
//   PUT|PATCH       api/Subscriptions/{Subscription} ................................. Subscriptions.update › Subscription\SubscriptionController@update  
//   DELETE          api/Subscriptions/{Subscription} ............................... Subscriptions.destroy › Subscription\SubscriptionController@destroy  
//   GET|HEAD        api/Subscriptions/{Subscription}/edit ................................ Subscriptions.edit › Subscription\SubscriptionController@edit 
class Main {

	use ApiCallerTrait;

    // Método para obtener un token de sesión con Sanctum
    public function getSessionToken($username, $password) {
        $data = [
            'username' => $username,
            'password' => $password,
        ];

        $response = $this->callApi('auth/token', 'POST', $data);

        if ($response && isset($response['token'])) {
            $session_token = $response['token'];
            return $session_token;
        } else {
            return false;
        }
    }

    // Método para crear un plan
    public function createPlan($planData) {
        $response = $this->callApi('plans', 'POST', $planData, true);

        if ($response && isset($response['id'])) {
            return $response['id'];
        } else {
            return false;
        }
    }

    // Método para crear una suscripción
    public function createSubscription($subscriptionData) {
        $response = $this->callApi('subscriptions', 'POST', $subscriptionData, true);

        if ($response && isset($response['id'])) {
            return $response['id'];
        } else {
            return false;
        }
    }

    // Método para realizar un pago directo
    public function makePayment($paymentData) {
        $response = $this->callApi('payments', 'POST', $paymentData, true);

        if ($response && isset($response['id'])) {
            return $response['id'];
        } else {
            return false;
        }
    }

    // Método para generar un enlace de pago
    public function generatePaymentLink($amount) {
        $data = [
            'amount' => $amount,
        ];

        $response = $this->callApi('payment-links', 'POST', $data, true);

        if ($response && isset($response['link'])) {
            return $response['link'];
        } else {
            return false;
        }
    }
}