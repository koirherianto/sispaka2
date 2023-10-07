@extends('layouts.landing')

@section('landing-content')
    <main id="main">
        <section class="inner-page">
            <div class="container">
                @include('adminlte-templates::common.errors')
                @include('flash::message')

                <h1>{{ $project->title }}</h1>

                @foreach ($project->getMedia('image_project') as $media)
                    <div class="swiper-slide my-3">
                        <img src="{{ $media->getUrl() }}" alt="{{ $project->title }}" class="img-fluid img-thumbnail"
                            style="max-width: 300px; max-height: 300px;">
                    </div>
                @endforeach

                <strong>
                    <p>Created By:
                        @foreach ($project->users as $user)
                            {{ $user->name }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </p>
                </strong>

                @php
                    $description = $project->description;
                    $maxLength = 2000;
                    $shortDescription = strlen($description) > $maxLength ? substr($description, 0, $maxLength) . '...' : $description;
                @endphp

                <div>
                    {!! html_entity_decode($shortDescription) !!}
                </div>

                @if (strlen($description) > $maxLength)
                    <button onclick="showReadMore()" id="read-more-button">Baca Selanjutnya</button>
                    <div id="read-more-section" style="display: none;">
                        {!! html_entity_decode(substr($description, $maxLength)) !!}
                    </div>
                @endif


                <h2 class="mt-5" >Choise Diagnoses</h2>

                {!! Form::open(['route' => ['expert-system.backward-chaining', $project->slug]]) !!}


                    {{-- input hidden slug --}}
                    {!! Form::hidden('slug', $project->slug) !!}
                    <div class="form-group col-sm-6 mt-3">
                        {!! Form::select('bc_result_id', $bcResults->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="card-footer mt-2">
                        {!! Form::submit('Next', ['class' => 'btn btn-dark']) !!}
                    </div>

                {!! Form::close() !!}

            </div>
        </section>
    </main>

    <script>
        let readMoreClicked = false;

        function showReadMore() {
            if (!readMoreClicked) {
                document.getElementById('read-more-section').style.display = 'block';
                document.getElementById('read-more-button').style.display = 'none';
                readMoreClicked = true;
            }
        }
    </script>
@endsection
