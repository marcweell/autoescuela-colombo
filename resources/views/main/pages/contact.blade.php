@extends('main.templates.inner',['page_title'=>'Sobre'])

@section('content')


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
