@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Автомобили
            <div class="float-right">
                <form method="GET" action="{{ route('cars.index') }}" style="display: inline-block">
                    <label>
                        <select id="make_id" class="form-control-sm" name="make" onchange="this.form.submit()">
                            <option value="">Все</option>
                            @foreach($makes as $make)
                                <option value="{{ $make->id }}" {{ isset($selectedMake) && $selectedMake == $make->id ? 'selected' : '' }}>{{ $make->name }}</option>
                            @endforeach
                        </select>
                    </label>
                </form>
                <a class="btn btn-sm btn-success" href="{{ route('cars.create') }}">Добавить Автомобиль</a>
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
                            <th>Марка</th>
                            <th>Модель</th>
                            <th>Год выпуска</th>
                            <th>Пробег</th>
                            <th>Цвет</th>
                            <th>Стоимость</th>
                            <th>Дата создания</th>
                            <th style="width: 20%">Действия</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="bg-light">
                            <th>Марка</th>
                            <th>Модель</th>
                            <th>Год выпуска</th>
                            <th>Пробег</th>
                            <th>Цвет</th>
                            <th>Стоимость</th>
                            <th>Дата создания</th>
                            <th>Действия</th>
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
                                    <a class="btn btn-sm btn-warning" href="{{ route('cars.edit', $model) }}">Редактировать</a>
                                    <form class="d-inline" method="POST" action="{{ route('cars.destroy', $model) }}">
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
