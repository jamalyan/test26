@csrf

<div class="form-group">
    <label for="name" class="col-form-label text-md-right">Name</label>

    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
           value="{{ old('name', isset($make) ? $make->name : '') }}" required autocomplete="name" autofocus>

    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<button type="submit" class="btn btn-primary float-right">{{ isset($make) ? 'Update' : 'Create' }}</button>
