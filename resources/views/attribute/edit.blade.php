@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Attribute Update</div>
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

                    <form action="{{ route('attribute.update', $edit->id) }}" method="post">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="color_id">Color</label> 
                            <select id="color_id" name="color_id" class="custom-select form-contro" style="width: 100%;">
                                <option value=""></option>
                                @foreach ($colors as $c)
                                    @if($c->id == $edit->color_id)
                                        <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                    @else
                                        <option value="{{ $c->id }}" >{{ $c->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="size_id">Size</label> 
                            <select id="size_id" name="size_id" class="custom-select form-contro" style="width: 100%;">
                                <option value=""></option>
                                @foreach ($sizes as $s)
                                    @if($s->id == $edit->size_id)
                                        <option value="{{ $s->id }}" selected>{{ $s->name }}</option>
                                    @else
                                        <option value="{{ $s->id }}" >{{ $s->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection