@extends('main.templates.inner', ['page_title' => 'Sobre'])

@section('content')
    <section class="inner-page">
        <div class="container">
            {!! _info('terms') !!}
        </div>
    </section>
@endsection
