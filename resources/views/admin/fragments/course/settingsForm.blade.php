@php
    
    $menus = [
        [
            'name' => __('Categorias de Curso'),
            'link' => route('web.admin.settings.course_category.index'),
            'icon' => 'fa fa-folder',
        ],
        [
            'name' => __('Areas de Negocio'),
            'link' => route('web.admin.course.business_area.index'),
            'icon' => 'fa fa-folder',
        ],
        [
            'name' => __('Tipos de Servico'),
            'link' => route('web.admin.course.service_type.index'),
            'icon' => 'fa fa-folder',
        ],
        [
            'name' => __('Tipos de Evento'),
            'link' => route('web.admin.course.event_category.index'),
            'icon' => 'fa fa-folder',
        ],
    ];
    $menus = json_decode(json_encode($menus));
    
@endphp
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>{{ __('Definicoes de Curso') }}<h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mx-n1 g-0">
            @foreach ($menus as $item)
                <div class="col-xxl-3 col-lg-6">
                    <div class="card m-1 shadow-none border">
                        <div class="p-2">
                            <a data-href="{{ $item->link }}" class="text-muted fw-bold _link_">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i class="fa fa-folder font-16"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col ps-0">{{ $item->name }}
                                    </div>
                                </div> <!-- end row -->
                            </a>
                        </div> <!-- end .p-2-->
                    </div> <!-- end col -->
                </div> <!-- end col-->
            @endforeach

        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->
