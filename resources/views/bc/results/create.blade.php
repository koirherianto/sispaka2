@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Backward Chaining Create Results |
                        @if (Auth::user()->hasRole('super-admin'))
                            Admin View 
                        @else
                            {{ Auth::user()->sessionProjects->title }}
                        @endif
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'bcResults.store','files' => true]) !!}

            <div class="card-body">

                <div class="row">
                    @include('bc.results.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('bcResults.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
