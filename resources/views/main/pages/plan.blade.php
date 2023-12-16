@extends('main.templates.main')

@section('content')



<div class="page-title">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-6">
                <div class="page-title-content">
                    <h3>{{ __("Fases") }}</h3> 
                </div>
            </div>
            <div class="col-auto">
                <div class="breadcrumbs"><a href="{{ route("web.public.index") }}">{{ __("Pagina Inicial") }}</a></div>
            </div>
        </div>
    </div>
</div>









<div class="trending-category section-padding bg-light triangle-top-light triangle-bottom-light">
    <div class="container">
        <div class="row align-items-center">
       

            @foreach ($plan as $item)
            
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card items">
                    <div class="card-body">
                        <div class="items-img position-relative">
                            <img src="{{ tools()->photo($item->icon) }}"
                                class="img-fluid rounded mb-3" alt=""> 
                        </div> 
                            <h4 class="card-title">{{ $item->name }}</h4> 
                        <p></p>
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="mb-2">
                                    {!! $item->description !!} 
                                </p> 
                            </div> 
                        </div>
                        <div class="d-flex justify-content-center mt-3"><a class="btn btn-primary"
                                href="javascript:void()">{{ $item->currency_symbol . format_number($item->price ?? 0) }}</a></div>
                    </div>
                </div>
            </div>
            

            @endforeach




        </div>
    </div>
</div>


 



@endsection



























 