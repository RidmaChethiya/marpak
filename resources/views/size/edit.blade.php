@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Size Update</div>
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

                    <form action="{{ route('size.update', $edit->id) }}" method="post">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="name">Size Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $edit->name }}" required>
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