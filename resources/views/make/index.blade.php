@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Справочник марок
            <div class="float-right">
                <a class="btn btn-sm btn-success" href="{{ route('makes.create') }}">Добавить Марку</a>
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
                            <th>Имя</th>
                            <th style="width: 20%">Дата создания</th>
                            <th style="width: 20%">Действия</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="bg-light">
                            <th>Имя</th>
                            <th>Дата создания</th>
                            <th>Действия</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($models as $model)
                            <tr>
                                <td>{{ $model->name }}</td>
                                <td>{{ $model->created_at ? $model->created_at->format('d M Y (H:i)') : '' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('makes.edit', $model) }}">Редактировать</a>
                                    <form class="d-inline" method="POST" action="{{ route('makes.destroy', $model) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
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
