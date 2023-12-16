<h4 class="header-title pt-2 pb-2 col-12"><i class="fa fa-file-tree-outline"></i> Pastas</h4>

<div class="row">

    @php
        $folders = [
            [
                'name' => 'APN',
                'route' => route('web.app.folder.explore.index',['code'=>'apn']),
            ],
            [
                'name' => 'Tutoriais',
                'route' => route('web.app.folder.explore.index',['code'=>'tutorial-text']),
            ],
            [
                'name' => 'Banners',
                'route' => route('web.app.folder.explore.index',['code'=>'banners']),
            ],
        ];
    @endphp











    @foreach ($folders as $item)
        <div class="col-xxl-3 col-lg-3 col-md-6">
            <div class="card m-1 shadow-none border">
                <div class="p-2">
                    <a data-href="{{ $item['route'] }}" class="text-muted fw-bold l14k">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-dark rounded">
                                        <i class="fa fa-folder font-16"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col ps-0">{{ $item['name'] }}
                                <!--p class="mb-0 font-13">2.3 MB</p-->
                            </div>
                        </div> <!-- end row -->
                    </a>
                </div> <!-- end .p-2-->
            </div> <!-- end col -->
        </div> <!-- end col-->
    @endforeach









</div>
