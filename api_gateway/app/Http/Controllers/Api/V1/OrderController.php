<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\OrderHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderHelper $orderHelper, private readonly AuthenticationHelper $authenticationHelper) {}

    public function index(Request $request)
    {
        try {
            $user = $this->authenticationHelper->me($request);
            $user = $user['user'];
            $request->merge([
                'user_id' => $user['id'],
            ]);
            $response = $this->orderHelper->get($request);

            return response()->json($response);
        } catch (HelperException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function create(Request $request)
    {
        try {
            $user = $this->authenticationHelper->me($request);
            $request->merge([
                'user_id' => $user['id'],
            ]);
            $response = $this->orderHelper->create($request);

            return response()->json($response);
        } catch (HelperException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
