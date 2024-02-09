@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Codes
                <a href="{{ route('code.create') }}" class="btn btn-info btn-sm">Create</a>
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
                                <th style="width: 80%">Code Name</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($code as $c)
                                <tr>
                                    <td>{{$c->id}}</td>
                                    <td>{{$c->name}}</td>
                                    <td>
                                        <form action="{{ route('code.edit', $c->id) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Edit</button>
                                            </form>
                                        <form action="{{ route('code.destroy', $c->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $code->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection