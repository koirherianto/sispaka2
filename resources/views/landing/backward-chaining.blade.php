@extends('layouts.landing')

@section('landing-content')
    <main id="main">
        <section class="inner-page">
            <div class="container">
                @include('adminlte-templates::common.errors')
                @include('flash::message')

                {!! Form::open(['route' => ['expert-system.backward-chaining-result', $project->slug]]) !!}
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
                                        {!! Form::checkbox('bcQuestion[]', $bcQuestion->id, false, [
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
                {!! Form::submit('Lets! Do It', ['class' => 'btn btn-dark']) !!}
                {!! Form::close() !!}

            </div>
        </section>
    </main>
@endsection
