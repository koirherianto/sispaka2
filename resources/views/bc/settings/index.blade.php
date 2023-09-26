@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Backward Chaining Setting |
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

            {!! Form::open(['route' => 'bcSetting.store']) !!}

            <div class="card-body">

                <div class="row">
                    <input type="hidden" name="backward_chaining_id" value="{{ $backwardChainings->id }}">
                    <div class="form-group col-sm-6">
                        {!! Form::label('status_redy', 'Is Backward Chaining Redy to Publish:') !!}
                        {!! Form::select('status_redy', ['yes' => 'Yes', 'no' => 'No'], $backwardChainings->status_redy, [
                            'class' => 'form-control',
                        ]) !!} </div>
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
