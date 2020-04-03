<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModelStoreRequest;
use App\Models\CarMake;
use App\Models\CarModel;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        /** @var CarModel $models */
        $models = CarModel::query()
            ->with('carMake')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('model.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $makes = CarMake::query()->pluck('name', 'id')->toArray();
        return view('model.create', compact('makes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ModelStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ModelStoreRequest $request)
    {
        $data = $request->except('_token');
        CarModel::query()->create($data);
        return redirect()->route('models.index')->with('my_response', ['class' => 'success', 'message' => 'Model successfully created']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarModel $model
     * @return Factory|View
     */
    public function edit(CarModel $model)
    {
        $makes = CarMake::query()->pluck('name', 'id')->toArray();
        return view('model.edit', compact('model', 'makes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ModelStoreRequest $request
     * @param CarModel $model
     * @return RedirectResponse
     */
    public function update(ModelStoreRequest $request, CarModel $model)
    {
        $model->update($request->except('_token'));
        return redirect()->route('models.index')->with('my_response', ['class' => 'success', 'message' => 'Model successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CarModel $model
     * @return RedirectResponse
     */
    public function destroy(CarModel $model)
    {
        try {
            $model->delete();
            return redirect()->route('models.index')->with('my_response', ['class' => 'success', 'message' => 'Model successfully deleted']);
        } catch (Exception $exception) {
            return redirect()->route('models.index')->with('my_response', ['class' => 'danger', 'message' => $exception->getMessage()]);
        }
    }
}
