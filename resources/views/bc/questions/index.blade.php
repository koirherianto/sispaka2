@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Backward Chaining Question |
                        @if (Auth::user()->hasRole('super-admin'))
                            Admin View | 
                        @endif
                        {{ Auth::user()->sessionProjects->title }}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route('bcQuestions.create') }}">
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
            @include('bc.questions.table')
        </div>
    </div>
@endsection
