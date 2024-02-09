@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Attributes
                    <a href="{{ route('attribute.create') }}" class="btn btn-info btn-sm">Create</a>
                </div>
                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div> 
                    @elseif (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 40%">Color Name</th>
                                <th style="width: 40%">Size Name</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attribute as $a)
                                <tr>
                                    <td>{{$a->id}}</td>
                                    <td>{{$a->color_name}}</td>
                                    <td>{{$a->size_name}}</td>
                                    <td>
                                        <form action="{{ route('attribute.edit', $a->id) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Edit</button>
                                            </form>
                                        <form action="{{ route('attribute.destroy', $a->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $attribute->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection