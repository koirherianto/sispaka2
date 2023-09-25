@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            @include('adminlte-templates::common.errors')

            <h1>{{ $diagnosis }}</h1>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Diagnosis Information</h3>
                        </div>
                        <div class="card-body">
                            <strong>Diagnosis Name:</strong> {{ $bcResult->name }}<br>
                            <strong>Description:</strong> {{ $bcResult->reason }}<br>
                            <strong>Solution:</strong> {{ $bcResult->solution }}<br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Question Details</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($bcResult->bcQuestions as $question)
                                    <li>{{ $question->question }} (Factor Value: {{ $question->bcFact->value_fact }})</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <p><a href="{{ route('trybc.selectResult') }}" class="btn btn-dark">Back to Homepage</a></p>

        </div>
    </section>
@endsection
