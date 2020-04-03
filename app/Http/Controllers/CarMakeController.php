<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeStoreRequest;
use App\Models\CarMake;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CarMakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        /** @var CarMake $models */
        $models = CarMake::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);;
        return view('make.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('make.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MakeStoreRequest $request
     * @return RedirectResponse
     */
    public function store(MakeStoreRequest $request)
    {
        $data = $request->except('_token');
        CarMake::query()->create($data);
        return redirect()->route('makes.index')->with('my_response', ['class' => 'success', 'message' => 'Make successfully created']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarMake $make
     * @return Factory|View
     */
    public function edit(CarMake $make)
    {
        return view('make.edit', compact('make'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MakeStoreRequest $request
     * @param CarMake $make
     * @return RedirectResponse
     */
    public function update(MakeStoreRequest $request, CarMake $make)
    {
        $make->update($request->except('_token'));
        return redirect()->route('makes.index')->with('my_response', ['class' => 'success', 'message' => 'Make successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CarMake $make
     * @return RedirectResponse
     */
    public function destroy(CarMake $make)
    {
        try {
            $make->delete();
            return redirect()->route('makes.index')->with('my_response', ['class' => 'success', 'message' => 'Make successfully deleted']);
        } catch (Exception $exception) {
            return redirect()->route('makes.index')->with('my_response', ['class' => 'danger', 'message' => $exception->getMessage()]);
        }
    }
}
