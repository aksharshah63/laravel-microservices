<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\HelperException;
use App\Helpers\AuthenticationHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function __construct(private readonly AuthenticationHelper $authenticationHelper) {}

    public function login(Request $request)
    {
        try {
            $response = $this->authenticationHelper->login($request);

            return response()->json($response);
        } catch (HelperException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function me(Request $request)
    {
        $response = $this->authenticationHelper->me($request);

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $response = $this->authenticationHelper->logout($request);

        return response()->json($response);
    }
}
