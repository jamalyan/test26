@csrf

<div class="form-group">
    <label for="name" class="col-form-label text-md-right">Name</label>

    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
           value="{{ old('name', isset($model) ? $model->name : '') }}" required autocomplete="name" autofocus>

    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="make_id" class="col-form-label text-md-right">Make</label>

    <select id="make_id" class="form-control @error('make_id') is-invalid @enderror" name="make_id">
        @foreach($makes as $id => $makeName)
            <option
                value="{{ $id }}" {{ isset($model) && $model->make_id == $id ? 'selected' : '' }}>{{ $makeName }}</option>
        @endforeach
    </select>

    @error('make_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary float-right">{{ isset($model) ? 'Update' : 'Create' }}</button>
