<?php

namespace App\Utils;

use Illuminate\Support\Facades\Http;

class GetUserInfo {
    public static function getUserInfo(): array {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/user/info');
        
        $user = $response->json();

        return $user;
    }
}

?>
