@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Attribute Create</div>
                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div> 
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('attribute.store') }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="color_id">Color</label> 
                            <select id="color_id" name="color_id" class="custom-select form-control" style="width: 100%;">
                                <option value=""></option>
                                @foreach ($colors as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="size_id">Size</label> 
                            <select id="size_id" name="size_id" class="custom-select form-control" style="width: 100%;">
                                <option value=""></option>
                                @foreach ($sizes as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection