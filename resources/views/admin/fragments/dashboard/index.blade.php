<div class="row">
    <div class="col-12 mb-3">

        <div class="card">
            <form action="" class="form_">
                <input type="hidden" name="init" value="1">

                <div class="card-body row">

                    <div class="col-md-6">
                        <div class="form-input pt-3">
                            <div class="form-label">Data Inicial</div>
                            <input type="date" name="start_date" class="form-control"
                                value="{{ $request->get('start_date') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-input pt-3">
                            <div class="form-label">Data Final</div>
                            <input type="date" name="end_date" class="form-control"
                                value="{{ $request->get('end_date') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-input pt-3">
                            <div class="form-label">Nome de Usuario</div>
                            <select type="text" name="user[]" class="form-control select2tg w-100"
                                multiple></select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-input pt-3">
                            <div class="form-label">Email</div>
                            <select type="email" name="email[]" class="form-control select2tg" multiple></select>
                        </div>
                    </div>


                    <div class="col-md-12 pt-2">
                        <button class="btn btn-primary float-end"><i class="fa fa-search"></i> Filtrar</button>
                    </div>


                </div>





            </form>
        </div>





    </div>
    @foreach ($content as $item)
        <div class="col-xl-4 col-md-4 col-sm-6">
            <div class="stat-widget d-flex align-items-center">
                <div class="widget-content">
                    <h6>{{ $item['title'] }}</h6>
                    <p>{{ $item['count'] }}</p>
                </div>
                <div class="widget-arrow">
                    <a class="text-info mb-0 border p-3" href="#"><span><i class="fa fa-external-link"></i></span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    $('.select2tg').select2({
        tags: true,
        theme: 'bootstrap-5',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',

    });
    $(".slider").slick({
        // normal options...
        infinite: true,
        slidesToShow: 1,
        dots: true,
    });
</script>
