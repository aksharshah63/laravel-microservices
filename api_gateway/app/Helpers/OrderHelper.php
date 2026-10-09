<?php

namespace App\Helpers;

class OrderHelper
{
    private string $orderServiceUrl;

    public function __construct()
    {
        $this->orderServiceUrl = config('services.custom_micro_services.order_service.url');
    }

    public function get(Request $request): array
    {
        try {
            $response = Http::withHeaders([
                'secret' => '12345',
            ])->get($this->orderServiceUrl.'/v1/orders', $request->all());
            if ($response->successful()) {
                return $response->json();
            }
            throw new HelperException($response->json()['message'], ResponseAlias::HTTP_UNAUTHORIZED);
        } catch (ConnectionException $e) {
            throw new HelperException($e->getMessage(), $e->getCode());
        }
    }

    public function create(Request $request): array
    {
        try {
            $response = Http::withHeaders([
                'secret' => '12345',
            ])->post($this->orderServiceUrl.'/v1/orders', $request->all());
            if ($response->successful()) {
                return $response->json();
            }
            throw new HelperException($response->json()['message'], ResponseAlias::HTTP_UNAUTHORIZED);
        } catch (ConnectionException $e) {
            throw new HelperException($e->getMessage(), $e->getCode());
        }
    }
}
