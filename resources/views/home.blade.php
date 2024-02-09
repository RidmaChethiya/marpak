@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
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

                    <form action="{{ route('generate_pdf') }}" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="page_size_id">Page Size</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="page_size_id" name="page_size_id" class="custom-select form-control">
                                    <option value=""></option>
                                    @foreach ($page_sizes as $ps)
                                    <option value="{{ $ps->id }}">{{ $ps->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="label_width">Labels Width</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" class="form-control" id="label_width" name="label_width" min="1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="label_height" >Labels Height</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" class="form-control" id="label_height" name="label_height" min="1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="page_orientation_id">Page Orientation</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="page_orientation_id" name="page_orientation_id" class="custom-select form-control">
                                    <option value=""></option>
                                    @foreach ($page_orientations as $po)
                                    <option value="{{ $po->id }}">{{ $po->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="label_date" >Labels Date</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" class="form-control" id="label_date" name="label_date" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="label_start_id">Label Start</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="label_start_id" name="label_start_id" class="custom-select form-control" onchange="getLabelRange()">
                                    <option value=""></option>
                                    @foreach ($codes as $ls)
                                    <option value="{{ $ls->id }}">{{ $ls->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="label_end_id">Label End</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="label_end_id" name="label_end_id" class="custom-select form-control" onchange="getLabelRange()">
                                    <option value=""></option>
                                    @foreach ($codes as $le)
                                    <option value="{{ $le->id }}">{{ $le->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="apply_range" >Apply Range</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" class="form-control" id="apply_range" name="apply_range" disabled>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </form>
                    <br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getLabelRange() {
        var apply_range = '';
        var label_start = $('#label_start_id :selected').text();
        var label_end = $('#label_end_id :selected').text();
        var code_length = $('#label_start_id option').length;
        var code_list = [];
        $('#label_start_id option').each(function() {
                code_list.push(this.text);
        });
        var is_code = 0;
        if(label_start != '' && label_end !='') {
            for (let i = 0; i < code_length; i++) {
                if (code_list[i] == label_start || is_code > 0) {
                    is_code = 1;
                    if (code_list[i] == label_end) {
                        is_code = 0;
                    }
                    if (apply_range == '') {
                        apply_range += code_list[i];
                    } else {
                        apply_range += ',' + code_list[i];
                    }
                }
            }
            $('#apply_range').val(apply_range);
        }
    }
</script>
@endsection

