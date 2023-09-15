@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Backward Chaining Facts |
                        @if (Auth::user()->hasRole('super-admin'))
                            Admin View |
                        @else
                            {{ Auth::user()->sessionProjects->title }}
                        @endif
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route('bcFacts.create') }}">
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
            @include('bc.facts.table')
        </div>
    </div>
@endsection
