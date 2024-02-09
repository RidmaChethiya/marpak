@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Size Create</div>
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

                    <form action="{{ route('size.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="name">Size Name</label>
                            <input type="text" class="form-control" id="name" name="name">
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
@push('script')
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = logo.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush