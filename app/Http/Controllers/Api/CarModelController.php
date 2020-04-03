<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        /** @var CarModel $data */
        $data = CarModel::with('carMake')
            ->when($request->get('make'), function (Builder $query, $make) {
                return $query->whereHas('carMake', function (Builder $q) use ($make) {
                    $q->where('name', $make);
                });
            })
            ->orderBy('name', 'asc')
            ->get();

        return response()->json(['message' => 'success', 'data' => $data], 200);
    }
}
