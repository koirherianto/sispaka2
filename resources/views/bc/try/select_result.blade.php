@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            @include('adminlte-templates::common.errors')

            <h1>Pilih Result</h1>
            
            {!! Form::open(['route' => 'trybc.selectQuestion']) !!}

            <div class="form-group col-sm-6 mt-3">
                {!! Form::label('bc_result_id', 'Result:') !!}
                {!! Form::select('bc_result_id', $bcResults->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="card-footer">
                {!! Form::submit('Next', ['class' => 'btn btn-dark']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </section>
@endsection
