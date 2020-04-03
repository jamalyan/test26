<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Models\Car;
use App\Models\CarMake;
use App\Models\CarModel;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        /** @var Car $models */
        $models = Car::query()
            ->with('carMake', 'carModel')
            ->orderBy('created_at', 'desc')
            ->paginate(10);;
        return view('car.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $makes = CarMake::with('carModels')->orderBy('name')->get();
        $models = $makes ? $makes->first()->carModels : [];
        return view('car.create', compact('makes', 'models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CarStoreRequest $request)
    {
        $data = $request->except('_token');
        Car::query()->create($data);
        return redirect()->route('cars.index')->with('my_response', ['class' => 'success', 'message' => 'Car successfully created']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Car $car
     * @return Factory|View
     */
    public function edit(Car $car)
    {
        $makes = CarMake::with('carModels')->orderBy('name')->get();
        $models = $car->carMake->carModels;
        return view('car.edit', compact('car', 'makes', 'models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarStoreRequest $request
     * @param Car $car
     * @return RedirectResponse
     */
    public function update(CarStoreRequest $request, Car $car)
    {
        $car->update($request->except('_token'));
        return redirect()->route('cars.index')->with('my_response', ['class' => 'success', 'message' => 'Car successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Car $car
     * @return RedirectResponse
     */
    public function destroy(Car $car)
    {
        try {
            $car->delete();
            return redirect()->route('cars.index')->with('my_response', ['class' => 'success', 'message' => 'Car successfully deleted']);
        } catch (Exception $exception) {
            return redirect()->route('cars.index')->with('my_response', ['class' => 'danger', 'message' => $exception->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|void
     */
    public function getCarModels(Request $request)
    {
        if ($request->ajax()) {
            $models = CarModel::query()->where('make_id', $request->get('make_id'))->pluck('name', 'id')->toArray();
            return response()->json(['models' => $models], 200);
        } else {
            return abort(404);
        }
    }
}
