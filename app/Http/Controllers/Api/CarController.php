<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        /** @var Car $data */
        $data = Car::with('carMake', 'carModel')
            ->when($request->get('make'), function (Builder $query, $make) {
                return $query->whereHas('carMake', function (Builder $q) use ($make) {
                    $q->where('name', $make);
                });
            })
            ->when($request->get('model'), function (Builder $query, $model) {
                return $query->whereHas('carModel', function (Builder $q) use ($model) {
                    $q->where('name', $model);
                });
            })
            ->when($request->get('year_from'), function (Builder $query, $year_from) {
                return $query->where('year', '>', $year_from);
            })
            ->when($request->get('year_to'), function (Builder $query, $year_to) {
                return $query->where('year', '<', $year_to);
            })
            ->when($request->get('mileage_from'), function (Builder $query, $mileage_from) {
                return $query->where('mileage', '>', $mileage_from);
            })
            ->when($request->get('mileage_to'), function (Builder $query, $mileage_to) {
                return $query->where('mileage', '<', $mileage_to);
            })
            ->when($request->get('price_from'), function (Builder $query, $price_from) {
                return $query->where('price', '>', $price_from);
            })
            ->when($request->get('price_to'), function (Builder $query, $price_to) {
                return $query->where('price', '<', $price_to);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['message' => 'success', 'data' => $data], 200);
    }
}
