@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Backward Chainings</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-info float-right"
                       href="{{ route('backwardChainings.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('bc.backward_chainings.table')
        </div>
    </div>

@endsection
