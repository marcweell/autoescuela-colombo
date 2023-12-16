<div class="row">

    @foreach ($plan as $item)
    
    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
        <div class="card items">
            <div class="card-header">
                @if ($item->active==false)
                <i class="fa fa-lock text-warning"></i>
                @endif
            </div>
            <div class="card-body">
                <div class="items-img position-relative">
                    <img data-src="{{ tools()->photo($item->icon) }}"
                        class="img-fluid rounded mb-3 w-100 lazy {{ $item->active == true?"":"bw" }}" alt=""> 
                </div> 
                    <h6 class="card-title text-center text-upppercase">{{ $item->name }}</h6>
                    <h5 class="text-center">{{ $item->currency_symbol . format_number($item->price ?? 0) }}</h5>
                <p></p>
                <div class="d-flex justify-content-between">
                    <div class="text-justify">
                        <p class="mb-1">
                            {!! $item->description !!} 
                        </p> 
                    </div> 
                </div>
                <div class="d-flex justify-content-center mt-3"><a class="btn {{ $item->active == true?"btn-primary":"btn-dark" }} l14k prompt"  data-href="{{ route('web.app.plan.join.do') }}" data-id="{{ $item->id }}" href="javascript:void()">ADERIR</a></div>
            </div>
        </div>
    </div>
    

    @endforeach



</div>