@extends('layouts.landing')

@section('landing-content')
    <main id="main">
        <section class="inner-page">
            <div class="container">
                @include('adminlte-templates::common.errors')
                @include('flash::message')

                <h1 class="display-4 mb-4">{{ $project->title }}</h1>

                <div class="image-slider">
                    @foreach ($project->getMedia('image_project') as $media)
                        <div class="swiper-slide">
                            <img src="{{ $media->getUrl() }}" alt="{{ $media->getCustomProperty('description') }}"
                                class="img-fluid">
                        </div>
                    @endforeach
                </div>

                <div class="row mt-4">
                    <div class="col-sm-8">
                        @php
                            $description = $project->description;
                            $maxLength = 2000;
                            $shortDescription = strlen($description) > $maxLength ? substr($description, 0, $maxLength) . '...' : $description;
                        @endphp

                        <div class="project-description">
                            {!! html_entity_decode($shortDescription) !!}
                            @if (strlen($description) > $maxLength)
                                <button onclick="showReadMore()" id="read-more-button" class="btn btn-link">Baca
                                    Selanjutnya</button>
                                <div id="read-more-section" style="display: none;">
                                    {!! html_entity_decode(substr($description, $maxLength)) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-white">
                            <div class="card-header">
                                <h3 class="card-title">Diagnosis Information</h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Contributor</th>
                                            <th>Contribution</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->contributors as $contributor)
                                            <tr class="table-link" data-href="{{ $contributor->link }}">
                                                <td class="text-primary font-weight-bold text-decoration-underline">{{ $contributor->name }}
                                                </td>
                                                <td>{{ $contributor->contribution }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <span>Anda bisa mendownload Jurnal InI:</span> <br>

                                @if ($project->hasMedia('jurnal_project'))
                                    <a href="{{ $project->getFirstMediaUrl('jurnal_project') }}" class="btn btn-dark mt-2"
                                        download>Download Jurnal</a>
                                @endif
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Coba Sistem Pakar</h3>
                            </div>
                            <div class="card-body">

                                <span>Anda Bisa Mencoba Sistem Pakar Secara Langsung</span>
                                {!! Form::open(['route' => ['expert-system.backward-chaining', $project->slug]]) !!}

                                {{-- input hidden slug --}}
                                {!! Form::hidden('slug', $project->slug) !!}
                                <div class="form-group mt-1">
                                    {!! Form::select('bc_result_id', $bcResults->pluck('name', 'id'), null, [
                                        'class' => 'form-control form-control-lg',
                                        'required',
                                    ]) !!}

                                </div>

                                <div class="card-footer mt-2">
                                    {!! Form::submit('Next', ['class' => 'btn btn-dark px-4 btn-block']) !!}
                                </div>


                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </section>
    </main>

    <script>
        
        // ini aplikasi untuk menampilkan baca selanjutnya
        let readMoreClicked = false;

        function showReadMore() {
            if (!readMoreClicked) {
                document.getElementById('read-more-section').style.display = 'block';
                document.getElementById('read-more-button').style.display = 'none';
                readMoreClicked = true;
            }
        }

        // ini aplikasi untuk agak linknya bisa diklik
        document.addEventListener("DOMContentLoaded", () => {
            const rows = document.querySelectorAll("tr.table-link");

            rows.forEach(row => {
                row.addEventListener("click", () => {
                    window.location.href = row.dataset.href;
                });
            });
        });
    </script>
@endsection
