 

@extends('main.templates.main')

@section('content')



<div class="page-title">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-6">
                <div class="page-title-content">
                    <h3>{{ __("Perguntas Frequentes") }}</h3> 
                </div>
            </div>
            <div class="col-auto">
                <div class="breadcrumbs"><a href="{{ route("web.public.index") }}">{{ __("Pagina Inicial") }}</a></div>
            </div>
        </div>
    </div>
</div>


<div class="item-single section-padding">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="top-bid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="accordion" id="accordionExample">
           

                                    @php
                                        $open = "true";
                                    @endphp
                                    @foreach ($faq as $item)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="{{  "heading".'n-'.$item->code }}">
                                            <button class="accordion-button text-dark {{ $open=="true"?"":"collapsed" }}" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#{{  'n-'.$item->code }}" aria-expanded="{{ $open }}"
                                                aria-controls="{{  'n-'.$item->code }}">
                                                <span><i class="far fa-question"></i></span> {!! $item->title !!}
                                            </button>
                                        </h2>
                                        <div id="{{  'n-'.$item->code }}" class="accordion-collapse {{ $open=="true"?"collapse show":"collapse" }}"
                                            aria-labelledby="{{  "heading".'n-'.$item->code }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body bg-dark">  {!! $item->description !!}
                                            </div>
                                        </div>
                                    </div>
                
                                        @php
                                            $open = "false";
                                        @endphp
                                    @endforeach
                                        
                
                
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 




@endsection
