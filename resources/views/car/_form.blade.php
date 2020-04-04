@csrf

<div class="form-group">
    <label for="make_id" class="col-form-label text-md-right">Марка</label>

    <select id="make_id" class="form-control @error('make_id') is-invalid @enderror" name="make_id">
        @foreach($makes as $make)
            <option
                value="{{ $make->id }}" {{ isset($car) && $car->make_id == $make->id ? 'selected' : '' }}>{{ $make->name }}</option>
        @endforeach
    </select>

    @error('make_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="model_id" class="col-form-label text-md-right">Модель</label>

    <select id="model_id" class="form-control @error('model_id') is-invalid @enderror" name="model_id">
        @foreach($models as $model)
            <option
                value="{{ $model->id }}" {{ isset($car) && $car->model_id == $model->id ? 'selected' : '' }}>{{ $model->name }}</option>
        @endforeach
    </select>

    @error('model_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="year" class="col-form-label text-md-right">Год выпуска</label>

    <select id="year" class="form-control @error('year') is-invalid @enderror" name="year">
        @for($i = date('Y'); $i >= 1885; $i--)
            <option value="{{ $i }}" {{ isset($car) && $car->year == $i ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
    </select>

    @error('year')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="mileage" class="col-form-label text-md-right">Пробег</label>

    <input id="mileage" type="number" class="form-control @error('mileage') is-invalid @enderror" name="mileage"
           value="{{ old('mileage', isset($car) ? $car->mileage : '') }}" required min="0" max="1000000" step="0.01">

    @error('mileage')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="color" class="col-form-label text-md-right">Цвет</label>

    <select id="color" class="form-control @error('color') is-invalid @enderror" name="color">
        @foreach(getAllColorNames() as $color)
            <option
                value="{{ $color }}" {{ isset($car) && $car->color == $color ? 'selected' : '' }}>{{ $color }}</option>
        @endforeach
    </select>

    @error('color')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="price" class="col-form-label text-md-right">Стоимость</label>

    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price"
           value="{{ old('price', isset($car) ? $car->price : '') }}" required min="0" max="1000000" step="0.01">

    @error('price')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<button type="submit" class="btn btn-primary float-right">{{ isset($car) ? 'Редактировать' : 'Добавить' }}</button>

@push('footer-post-scripts')
    <script>
        $(document).on('change', '#make_id', function () {
            let make_id = $(this).val();
            $.ajax({
                url: '{{ route('get.car.models') }}',
                type: 'POST',
                data: {make_id: make_id},
                success: function (data) {
                    var $el = $("#model_id");
                    $el.empty();
                    var newOptions = data.models;
                    $.each(newOptions, function (value, key) {
                        $el.append($("<option></option>").attr("value", value).text(key));
                    });
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    alert(errorMessage)
                }
            });
        });
    </script>
@endpush
