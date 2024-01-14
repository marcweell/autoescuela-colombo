@extends('main.templates.home')

@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="container text-center">
                <div class="section-title">
                    <h5>Nosotros</h5>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                        consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                        fugiat
                        sit in iste officiis commodi quidem hic quas.</p>
                </div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-7 position-relative about-img" style="background-image: url(assets/img/about.jpg) ;"
                    data-aos="fade-up" data-aos-delay="150">
                    <div class="call-us position-absolute">
                        <h4>Auto escula Colombo</h4>
                        <p>+1 5589 55488 55</p>
                    </div>
                </div>
                <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et
                            dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </li>
                            <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.
                            </li>
                            <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute
                                irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat
                                nulla
                                pariatur.</li>
                        </ul>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                            in
                            voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident
                        </p>

                        <div class="position-relative mt-4">
                            <img src="assets/img/about-2.jpg" class="img-fluid" alt="">
                            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->




    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container">

            <div class="section-title">
                <h5>Galeria</h5>
                <p></p>
            </div>
        </div>

        <div class="container-fluid  g-0">
            <div class="row g-0">

                @foreach ($gallery ?? [] as $item)
                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ url('storage/files/gallery/original/' . $item->archive) }}"
                                class="galelry-lightbox">
                                <img src="{{ url('storage/files/gallery/square/' . $item->archive) }}" alt=""
                                    class="w-100">
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section><!-- End Gallery Section -->


    <!-- ======= Cursos ======= -->
    <section id="cursos" class="cursos section-bg">
        <div class="container">

            <div class="section-title">
                <h5>Cursos</h5>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit
                    in iste officiis commodi quidem hic quas.</p>
            </div>
        </div>
        <div class="container">
            <div class="faq-list">
                <ul>
                    <li data-aos="fade-up">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                            data-bs-target="#faq-list-1">Motocicleta - M<i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                            <div class="row">
                                <div class="col-lg-8 details">
                                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde
                                        sonata raqer
                                        a videna mareta paulona marka</p>
                                    <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos
                                        ipsum ipsa
                                        odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et
                                        quis magni
                                        nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>

                                </div>
                                <div class="col-lg-4 text-center">
                                    <div class="portfolio-thumb">
                                        <img src="assets/img/moto_t.jpg" alt="" class="img-fluid">
                                    </div>

                                </div>


                                <div class="col-lg-12">
                                    <button type="button"
                                        class="active animate__animated animate__fadeInUp scrollto">curso 1</button>
                                    <button type="button"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Curso
                                        2</button>
                                    <button type="button"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Curso
                                        3</button>
                                    <button type="button"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto">Curso
                                        4</button>
                                    <p>Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a
                                        videna mareta
                                        paulona marka</p>
                                    <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos
                                        ipsum ipsa
                                        odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et
                                        quis magni
                                        nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                                    <button type="button"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto"><a
                                            href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox"><i
                                                class="bi bi-file-pdf-fill"></i> Ver video </a></button>
                                    <button type="button"
                                        class="btn-get-started animate__animated animate__fadeInUp scrollto"> <i
                                            class="bi bi-journal-richtext"></i> Simulador de Examen Teórico</button>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-2" class="collapsed">Particular - P <i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit
                                laoreet id
                                donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est
                                pellentesque elit
                                ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-3" class="collapsed">Profesional – A<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar
                                elementum
                                integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu
                                tincidunt.
                                Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed
                                odio morbi
                                quis
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-4" class="collapsed">Profesional – B<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est
                                ante in. Nunc
                                vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est.
                                Purus
                                gravida quis blandit turpis cursus in.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-5" class="collapsed">Profesional – C<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer
                                malesuada
                                nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut
                                venenatis
                                tellus in metus vulputate eu scelerisque.
                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="500">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-6" class="collapsed">Maquinaria Pesada – T<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer
                                malesuada
                                nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut
                                venenatis
                                tellus in metus vulputate eu scelerisque.
                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="500">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-7" class="collapsed">Manejo Defensivo<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer
                                malesuada
                                nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut
                                venenatis
                                tellus in metus vulputate eu scelerisque.
                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="500">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-8" class="collapsed">Mantenimiento de Mecánica Automotriz<i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer
                                malesuada
                                nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut
                                venenatis
                                tellus in metus vulputate eu scelerisque.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </section><!-- End Frequently Asked Questions Section -->


    <section class="section-medium section-arrow--bottom-center bg" id="section-medium">
        <div class="container" data-aos="zoom-in">
            <div class="row">
                <div class="col-md-12 text-center section-title">
                    <h5>Simulador de Examen Teórico</h5>
                    <p>Con este simulador podrás practicar antes de enfrentar el examen teórico real, con el fin de que
                        llegues
                        bien preparado para rendir.
                        (Actualizado Agosto 2022)</p>
                </div>
            </div>
        </div>
    </section>



    <!-- ======= Features Section ======= -->
    <section id="features" class="features section-bg">
        <div class="container" data-aos="fade-up">

            <ul class="nav nav-tabs row  g-2 d-flex">

                <li class="nav-item col-2">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-M">
                        <h4>M</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item col-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-P">
                        <h4>P</h4>
                    </a>
                </li>
                <!-- End tab nav item -->

                <li class="nav-item col-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-A">
                        <h4>A</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item col-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-d">
                        <h4>B</h4>
                    </a>
                </li><!-- End tab nav item -->
                <li class="nav-item col-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-d">
                        <h4>C</h4>
                    </a>
                </li><!-- End tab nav item -->
                <li class="nav-item col-2">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-d">
                        <h4>T</h4>
                    </a>
                </li><!-- End tab nav item -->

            </ul>

            <div class="tab-content">

                <div class="tab-pane active show" id="tab-M">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                            data-aos="fade-up" data-aos-delay="100">
                            <h3>Motocicleta -M</h3>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et
                                dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</li>
                                <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate
                                    velit.</li>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis
                                    aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu
                                    fugiat nulla
                                    pariatur.</li>
                            </ul>
                            <button type="button" class="btn-get-started animate__animated animate__fadeInUp scrollto">
                                <i class="bi bi-journal-richtext"></i> Prueba Examen Teórico</button>
                            <button type="button" class="btn-get-started animate__animated animate__fadeInUp scrollto">
                                <i class="bi bi-journal-richtext"></i> Simulador de Examen Teórico completo</button>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                            <img src="assets/img/moto.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div><!-- End tab content item -->

                <div class="tab-pane" id="tab-P">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                            <h3>Particular - P</h3>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et
                                dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</li>
                                <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate
                                    velit.</li>
                                <li><i class="bi bi-check2-all"></i> Provident mollitia neque rerum asperiores dolores quos
                                    qui a.
                                    Ipsum neque dolor voluptate nisi sed.</li>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis
                                    aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu
                                    fugiat nulla
                                    pariatur.</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="assets/img/particular.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div><!-- End tab content item -->

                <div class="tab-pane" id="tab-A">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                            <h3>Profesional – A</h3>
                            <ul>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</li>
                                <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate
                                    velit.</li>
                                <li><i class="bi bi-check2-all"></i> Provident mollitia neque rerum asperiores dolores quos
                                    qui a.
                                    Ipsum neque dolor voluptate nisi sed.</li>
                            </ul>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et
                                dolore
                                magna aliqua.
                            </p>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="assets/img/profesional.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div><!-- End tab content item -->

                <div class="tab-pane" id="tab-d">
                    <div class="row">
                        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                            <h3>Omnis fugiat ea explicabo sunt</h3>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et
                                dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</li>
                                <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate
                                    velit.</li>
                                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis
                                    aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu
                                    fugiat nulla
                                    pariatur.</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 text-center">
                            <img src="assets/img/features-4.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div><!-- End tab content item -->

            </div>

        </div>
    </section><!-- End Features Section -->



    <!-- ======= Features Section ======= -->
    <section id="register" class="register section-bg">
        <div class="container" data-aos="fade-up">

            <ul class="nav nav-tabs row  g-2 d-flex">

                <li class="nav-item col-6">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-curso">
                        <h4>Inscripción curso de conducción</h4>
                    </a>
                </li><!-- End tab nav item -->

                <li class="nav-item col-6">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-examen">
                        <h4>Inscripción examen de conducción</h4>
                    </a>
                </li>
                <!-- End tab nav item -->

            </ul>

            <div class="tab-content">

                <div class="tab-pane active show" id="tab-curso">
                    <div class="row">
                        <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                            data-aos="fade-up" data-aos-delay="100">
                            <h4>Inscripción curso</h4>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et
                                dolore
                                magna aliqua.
                            </p>
                            <form>
                                <div class="row php-email-form">
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="form-label">Apellido paterno</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Apellido materno</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Carnet de Identidad</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="form-label">Celular</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Correo</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="form-label">Dirección</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Categoría</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Categoría M</option>
                                            <option>Categoría P</option>
                                            <option>Categoría A</option>
                                            <option>Categoría B</option>
                                            <option>Categoría C</option>
                                            <option>Categoría T</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Curso de
                                            conducción</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Básico</option>
                                            <option>Perfeccionamiento</option>
                                            <option>Especializado para el examen</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div><!-- End tab content item -->

                <div class="tab-pane" id="tab-examen">
                    <div class="row">
                        <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                            data-aos="fade-up" data-aos-delay="100">
                            <h4>Inscripción examen</h4>
                            <p class="fst-italic">
                                Los días de examen Teórico y Práctico son; miércoles y viernes todas las semanas, inicio a
                                horas
                                08:00.
                            </p>
                            <p>
                                NOTA: El proceso de inscripción al examen de conducir virtual Formulario 9.2, es válido 24
                                horas antes
                                del examen, Ejm. si usted tiene en mente realizar el
                                examen un miércoles y realizo el proceso de inscripción martes 12 horas antes NO ES VALIDO,
                                de manera
                                inmediata se pondrá en contacto nuestros
                                encargados para brindarle mayor información y darle próximas fechas de examen que el alumno
                                debera
                                elegir.
                            </p>
                            <form>
                                <div class="row php-email-form">
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="form-label">Apellido paterno</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Apellido materno</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Carnet de Identidad</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="form-label">Celular</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Correo</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="form-label">Dirección</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Categoría</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Categoría M</option>
                                            <option>Categoría P</option>
                                            <option>Categoría A</option>
                                            <option>Categoría B</option>
                                            <option>Categoría C</option>
                                            <option>Categoría T</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Curso de
                                            conducción</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Básico</option>
                                            <option>Perfeccionamiento</option>
                                            <option>Especializado para el examen</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Pdf carnet</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Pdf evaluación
                                            médica</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputPassword1" class="form-label">Foto fondo blanco</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                    <div class="col-md-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <div class="col-md-12">
                                        <p>Para terminar el proceso de inscripción el postulante deberá enviar los
                                            siguientes documentos:
                                        </p>
                                        <ul>
                                            <li><i class="bi bi-check2-all"></i> Pdf carnet ambas caras (Botón de carga)
                                            </li>
                                            <li><i class="bi bi-check2-all"></i> Pdf evaluación médica ambas caras (Botón
                                                de carga)</li>
                                            <li><i class="bi bi-check2-all"></i> Foto fondo blanco, sin lentes, sin aretes,
                                                sin barbijo, sin
                                                collar (Formato PNG o JPG) </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Features Section -->






























    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h5>Preguntas frecuentes</h5>
                <p>Te mostramos información y las respuestas a las principales preguntas frecuentes que nos suelen hacer en
                    Autoescuela Colombo.</p>
            </div>


            @foreach ($faq ?? [] as $item)
                <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-5">
                        <i class="bx bx-help-circle"></i>
                        <h4>{{ $item->title }}</h4>
                    </div>
                    <div class="col-lg-7">
                        {!! $item->description !!}
                    </div>
                </div><!-- End F.A.Q Item-->
            @endforeach

        </div>
    </section><!-- End Frequently Asked Questions Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h5>Buzón de quejas y sugerencias</h5>
                <p>Te mostramos información y las respuestas a las principales preguntas frecuentes que nos suelen hacer en
                    Autoescuela Colombo.</p>
            </div>

            <div class="row">

                <div class="col-lg-6">

                    <div class="row">
                        <div class="col-md-12">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15231.900087568945!2d-66.1746929!3d-17.3649349!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93e3755d8ef3e249%3A0xfd333fc28386138c!2sAutoescuela%20colombo!5e0!3m2!1sit!2sbo!4v1698840472547!5m2!1sit!2sbo"
                                width="100%" height="370" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <form action="{{ route('web.public.api.message.send') }}" method="post" role="form"
                        class="php-email-form form_">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Su Nombre" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Sujeto" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="text-center mt-4"><button type="submit">Send Messaje</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
@endsection
