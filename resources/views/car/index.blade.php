@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Cars
            <div class="float-right">
                <a class="btn btn-sm btn-success" href="{{ route('cars.create') }}">Add Car</a>
            </div>
        </div>
        <div class="card-body">
            @if(session()->has('my_response'))
                <div class="alert alert-{{ session()->get('my_response')['class'] }}">
                    {{ session()->get('my_response')['message'] }}
                </div>
            @endif
            @if($models->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                        <tr class="bg-light">
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Mileage</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th style="width: 15%">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="bg-light">
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Mileage</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($models as $model)
                            <tr>
                                <td>{{ $model->carMake->name }}</td>
                                <td>{{ $model->carModel->name }}</td>
                                <td>{{ $model->year }}</td>
                                <td>{{ $model->mileage }}</td>
                                <td>{{ $model->color }}</td>
                                <td>{{ $model->price }}</td>
                                <td>{{ $model->created_at ? $model->created_at->format('d M Y (H:i)') : '' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('cars.edit', $model) }}">Edit</a>
                                    <form class="d-inline" method="POST" action="{{ route('cars.destroy', $model) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="float-right">{{ $models->links() }}</div>
            @else
                No Data
            @endif
        </div>
    </div>
@endsection
