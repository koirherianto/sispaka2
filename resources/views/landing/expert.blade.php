@extends('layouts.landing')

@section('landing-content')
    <main id="main">
        <section class="inner-page">
            <div class="container">
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

                {!! html_entity_decode($project->description) !!}
            </div>
        </section>
    </main>
@endsection

{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <title>{{ $project->title }} - {{ config('app.name') }}</title>
    <meta name="description" content="{{ $project->short_description }}">
    <meta name="keywords" content="{{ $project->tag_keyword }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Menambahkan CSS khusus untuk mengubah warna navbar menjadi ungu */
        .bg-purple {
            background-color: rgb(104, 32, 104);
        }

        /* Menambahkan gaya untuk menempatkan gambar di tengah kolom */
        .center-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="container bg-light">


    <!-- Konten lainnya di atas jika diperlukan -->

    <!-- Detail Proyek Section -->
    <section id="project-details " class="project-details mt-3 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-right"> <!-- Menambahkan class center-image -->
                    <h1>{{ $project->title }}</h1> <!-- Pindahkan judul ke atas gambar -->
                    <div class="project-details-slider swiper-container center-image mt-3 mb-4">
                        <div class="swiper-wrapper">
                            <!-- Tambahkan gambar-gambar proyek di sini -->
                            @foreach ($project->getMedia('image_project') as $media)
                                <div class="swiper-slide">
                                    <img src="{{ $media->getUrl() }}" alt="{{ $project->title }}"
                                        class="img-fluid img-thumbnail" style="max-width: 300px; max-height: 300px;">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-12" data-aos="fade-left">
                    <div class="project-details-content">
                        {!! html_entity_decode($project->description) !!} <!-- Pindahkan deskripsi ke bawah gambar -->
                        <strong>
                            <p>Created By:
                                @foreach ($project->users as $user)
                                    {{ $user->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </p>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Detail Proyek Section -->

    <!-- Konten lainnya di bawah jika diperlukan -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html> --}}
