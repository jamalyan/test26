@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fas fa-server"></i> Car Makes
            <div class="float-right">
                <a class="btn btn-sm btn-success" href="{{ route('makes.create') }}">Add Make</a>
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
                            <th>Name</th>
                            <th style="width: 25%">Created</th>
                            <th style="width: 15%">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="bg-light">
                            <th>Name</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($models as $model)
                            <tr>
                                <td>{{ $model->name }}</td>
                                <td>{{ $model->created_at ? $model->created_at->format('d M Y (H:i)') : '' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('makes.edit', $model) }}">Edit</a>
                                    <form class="d-inline" method="POST" action="{{ route('makes.destroy', $model) }}">
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
