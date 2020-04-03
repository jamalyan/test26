@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-server"></i> Edit Make</div>
        <div class="card-body">
            <div class="col-md-6 offset-3">
                <form method="POST" action="{{ route('makes.update', ['make' => $make]) }}">
                    @method('PUT')
                    @include('make._form')
                </form>
            </div>
        </div>
    </div>
@endsection
