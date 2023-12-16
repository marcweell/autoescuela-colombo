<div style="background-repeat: no-repeat;min-height: 80vh;background-image:url('{{ url('public/assets/img/dashboard.png') }}');background-size: contain;padding: 0 !important;background-position-y: center;background-position-x: center;">

<h1 class="text-uppercase">{{ __("bem-vindo/a") }}, <div class="d-inline text-info">{{  implode(" ",[$user->name,$user->last_name]) }}</div></h1>
    
</div>

