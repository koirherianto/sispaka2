@extends('layouts.landing')

@section('landing-content')
    <main id="main">
        <section class="inner-page">
            <div class="container">
                @include('adminlte-templates::common.errors')
                @include('flash::message')

                <h1>{{ $project->title }}
                    @if ($isResult)
                        - {{ $bcResult->name }}
                    @endif
                </h1>

                {!! Form::open(['route' => ['expert-system.backward-chaining', $project->slug], 'id' => 'bcForm']) !!}
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        {!! Form::hidden('slug', $project->slug) !!}
                        {!! Form::hidden('isResult', true) !!}
                        @foreach ($bcQuestions as $bcQuestion)
                        <tr>
                            <td>{{ $bcQuestion->question }}</td>
                            <td>
                                <div class="form-check">
                                    {!! Form::checkbox('bcQuestion[]', $bcQuestion->id, is_array($request->bcQuestion) && in_array($bcQuestion->id, $request->bcQuestion), [
                                        'class' => 'form-check-input',
                                        'id' => 'bcQuestion-' . $bcQuestion->id,
                                    ]) !!}
                                    <label class="form-check-label" for="bcQuestion-{{ $bcQuestion->id }}"></label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
                {!! Form::submit('Hitung', ['class' => 'btn btn-dark']) !!}
                {!! Form::close() !!}

                @if ($isResult)
                    <h2 class="mt-3">{{ $diagnosis }}</h2>

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
                                            <li>{{ $question->question }} (Factor Value:
                                                {{ $question->bcFact->value_fact }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('expert-system.blog', $project->slug) }}" class="btn btn-dark mt-2">Ulangi</a>
                @endif

            </div>
        </section>
    </main>

    <script>
        document.getElementById('bcForm').addEventListener('submit', function(event) {
            var checkboxes = document.querySelectorAll('input[name="bcQuestion[]"]');
            var isChecked = false;
    
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    isChecked = true;
                }
            });
    
            if (!isChecked) {
                event.preventDefault(); // Mencegah pengiriman formulir
                alert('Pilih setidaknya satu pertanyaan.');
            }
        });
    </script>
    
@endsection
