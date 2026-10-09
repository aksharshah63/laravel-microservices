<?php

namespace App\Helpers;

use App\Exceptions\HelperException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthenticationHelper
{
    private string $authenticationUrl;

    public function __construct()
    {
        $this->authenticationUrl = config('services.custom_micro_services.authentication_service.url');
    }

    public function login(Request $request): array
    {
        try {
            $response = Http::withHeaders([
                'secret' => '12345',
            ])->post($this->authenticationUrl.'/v1/authentication/login', $request->all());
            if ($response->successful()) {
                return $response->json();
            }
            throw new HelperException($response->json()['message'] ?? 'Unknown', ResponseAlias::HTTP_UNAUTHORIZED);
        } catch (ConnectionException $e) {
            throw new HelperException($e->getMessage(), $e->getCode());
        }
    }

    public function me(Request $request): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$request->bearerToken(),
            ])->get($this->authenticationUrl.'/v1/me', $request->all());
            if ($response->successful()) {
                return $response->json();
            }
            throw new HelperException($response->json()['message'], ResponseAlias::HTTP_UNAUTHORIZED);
        } catch (ConnectionException $e) {
            throw new HelperException($e->getMessage(), $e->getCode());
        }
    }

    public function logout(Request $request): array
    {
        try {
            $response = Http::post($this->authenticationUrl.'/authentication/logout', $request->all());
            if ($response->successful()) {
                return $response->json();
            }
            throw new HelperException($response->json()['message'], ResponseAlias::HTTP_UNAUTHORIZED);
        } catch (ConnectionException $e) {
            throw new HelperException($e->getMessage(), $e->getCode());
        }
    }
}
