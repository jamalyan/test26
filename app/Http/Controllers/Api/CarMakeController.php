<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarMake;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarMakeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        /** @var CarMake $data */
        $data = CarMake::all();

        return response()->json(['message' => 'success', 'data' => $data], 200);
    }
}
