@extends('layouts.landing')

@section('landing-content')

    <body>
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">

            <div class="container-fluid" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1>Buat Sistem Pakar Tanpa Kode</h1>
                        <h2>Jangan biarkan penelitian Sistem Pakar anda berakhir pada jurnal yang tidak terbaca</h2>
                        <div style="text-align: left;">
                            <a href="#services" class="btn-get-started scrollto"
                                style="display: inline-block; margin-right: 10px;">Coba Sekarang</a>
                            <a href="/projects" class="btn-get-started scrollto" style="display: inline-block;">Buat Sistem
                                Pakar</a>
                        </div>

                    </div>
                    <div class="col-xl-4 col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="150">
                        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="Ilustrasi Aplikasi Sistem Pakar">
                    </div>
                </div>
            </div>

        </section><!-- End Hero -->


        <main id="main">

            <!-- ======= Services Section ======= -->
            <section id="services" class="services section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Cari Sistem Pakar</h2>
                        <p>"Anda dapat menggunakan sistem pakar kami secara gratis dan dengan mudah. Kami percaya bahwa
                            pengetahuan dan keahlian dalam berbagai bidang harus dapat diakses oleh semua orang di seluruh
                            dunia. Oleh karena itu, kami menyediakan platform yang memungkinkan para ahli di berbagai
                            disiplin ilmu untuk berkontribusi dan berbagi pengetahuan mereka."</p>
                    </div>

                    <div class="form-group col-sm-12 mb-3" style="text-align: center;">
                        {!! Form::text('title', null, [
                            'class' => 'form-control mt-2',
                            'required',
                            'maxlength' => 100,
                            'style' => 'border: none; outline: none; border-bottom: 2px solid purple;',
                            'placeholder' => 'Cari disini',
                        ]) !!}
                    </div>


                    <div class="row gy-4">
                        @foreach ($projects as $project)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box iconbox-blue">
                                <a href="/expert-system/{{ $project->slug }}" class="text-dark">
                                <div class="icon">
                                    <img src="{{ $project->getImageUrl() }}" 
                                        alt="{{ $project->getFirstMedia('image_project')->getCustomProperty('description') }}"
                                        style="width: 300px; height: 100px; object-fit: cover; border-radius: 10px;">
                                </div>
                                <h4> {{ $project->title }} </h4>
                                <p>{{ $project->short_description }}</p>
                                </a>
                                <div class="btn-wrap mt-2">
                                    <strong>
                                        <a href="/projects/{{ $project->id }}" class="btn-buy btn-secondary">Created By
                                            @foreach ($project->users as $user)
                                                {{ $user->name }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </a>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    


                </div>
            </section><!-- End Services Section -->

            <!-- ======= Frequently Asked Questions Section ======= -->
            <section id="faq" class="faq">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Pertanyaan yang Sering Diajukan (FAQ)</h2>
                        <p>Temukan Jawaban untuk Pertanyaan Umum tentang Aplikasi Sistem Pakar</p>
                    </div>

                    <div class="faq-list">
                        <ul>
                            <li data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                    data-bs-target="#faq-list-1">Apa itu FAQ (Frequently Asked Questions)? <i
                                        class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                                    <p>
                                        FAQ adalah singkatan dari Frequently Asked Questions, yang berarti "Pertanyaan yang
                                        Sering Diajukan." Ini adalah daftar pertanyaan umum yang sering diajukan oleh
                                        pengguna aplikasi sistem pakar kami tentang berbagai aspek aplikasi. FAQ berguna
                                        untuk memberikan jawaban cepat kepada pengguna dan mengurangi beban pertanyaan yang
                                        sama berulang kali.
                                    </p>
                                </div>
                            </li>

                            <li data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                    data-bs-target="#faq-list-2" class="collapsed">Bagaimana cara menggunakan aplikasi ini?
                                    <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Untuk menggunakan aplikasi ini, Anda perlu membuat akun dan masuk ke dalam sistem.
                                        Setelah masuk, Anda dapat membuat proyek sistem pakar, mengundang orang lain untuk
                                        berkolaborasi, dan memilih metode seperti backward \ forward chaining atau yang
                                        lainya untuk mengembangkan sistem pakar Anda.
                                    </p>
                                </div>
                            </li>

                            <li data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                    data-bs-target="#faq-list-3" class="collapsed">Apakah saya dapat membuat lebih dari satu
                                    proyek sistem pakar? <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Ya, Anda dapat membuat lebih dari satu proyek sistem pakar dalam satu akun. Aplikasi
                                        kami mendukung pembuatan multiple proyek untuk keperluan berbeda.
                                    </p>
                                </div>
                            </li>

                            <li data-aos="fade-up" data-aos-delay="400">
                                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                    data-bs-target="#faq-list-4" class="collapsed">Dapatkah saya menggunakan berbagai metode
                                    sistem pakar dalam satu proyek? <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Ya, Anda dapat menggunakan berbagai metode sistem pakar dalam satu proyek. Aplikasi
                                        kami mendukung berbagai metode seperti backward chaining, forward chaining, dan
                                        lainnya, sehingga Anda dapat memilih yang paling sesuai dengan kebutuhan Anda.
                                    </p>
                                </div>
                            </li>

                            <li data-aos="fade-up" data-aos-delay="500">
                                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                    data-bs-target="#faq-list-5" class="collapsed">Bagaimana cara berkolaborasi dengan orang
                                    lain dalam satu proyek? <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                                    <p>
                                        Untuk berkolaborasi dalam satu proyek, Anda dapat mengundang orang lain dengan
                                        menggunakan fitur berbagi proyek. Mereka dapat bergabung dalam proyek dan bekerja
                                        sama dengan Anda dalam mengembangkan sistem pakar tersebut.
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </section><!-- End Frequently Asked Questions Section -->


        </main><!-- End #main -->
    @endsection
