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

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/user/info');
        $user = $response->json();

        return $user;
    }
}

?>
