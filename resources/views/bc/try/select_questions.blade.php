@extends('layouts.app')

@section('content')
    <section class="content-header px-3">
        <div class="container-fluid">
            @include('adminlte-templates::common.errors')
            @include('flash::message')

            <h1 class="mb-3">
                Backward Chaining Try |
                @if (Auth::user()->hasRole('super-admin'))
                    Admin View |
                @endif
                {{ Auth::user()->sessionProjects->title }}

            </h1>

            {!! Form::open(['route' => 'trybc.results', 'method' => 'post']) !!}
            @include('flash::message')
            <table class="table">
                <thead>
                    <tr>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                    </tr>
                </thead>
                <tbody>
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
@endsection
