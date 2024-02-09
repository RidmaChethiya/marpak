@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('code.index') }}">Product Codes</a></div>
                <div class="card-header"><a href="{{ route('color.index') }}">Product Colors</a></div>
                <div class="card-header"><a href="{{ route('size.index') }}">Product Sizes</a></div>
                <div class="card-header"><a href="{{ route('attribute.index') }}">Product Attributess</a></div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection
