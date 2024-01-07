@extends('main.templates.inner', ['page_title' => 'Cursos'])

@section('content')
    <section class="inner-page">
        <div class="container"><div class="row">


            @foreach ($course as $item)

            <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                    <h4 class="text-center"><i class="bi-window m-auto text-primary"></i></h4>
                    <h3>{{ $item->name }}</h3>
                    <p class="lead mb-0">{!! $item->description !!}</p>
                </div>
            </div>
            @endforeach

        </div>
    </section>
@endsection
