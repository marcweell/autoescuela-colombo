<h4 class="header-title pt-2 pb-2 col-12"><i class="fa fa-file-tree-outline"></i> Pastas > {{ $folder->name }}</h4>

<div class="row">



    @foreach ($files ?? [] as $item)
        @php
            $arr = explode('.', $item->content);
            $ext = $arr[array_key_last($arr)];
            $ext = strtolower($ext);

        @endphp


        <div class="col-xxl-3 col-lg-3 col-md-6">
            <div class="card m-1 shadow-none border">
                <div class="p-2">
                    <a target="_blank" href="{{ url('storage/files/' . $item->content) }}" class="text-muted fw-bold">
                        <div class="row align-items-center">
                            <div class="col-12">
                                @switch($ext)
                                @case('pdf')
                                    <embed src="{{ url('storage/files/' . $item->content) }}" class="w-100" height="120"
                                        type="application/pdf"  toolbar="0">
                                @break
                                @case('jpg')
                                @case('png')
                                @case('jpeg')
                                @case('gif')
                                    <img src="{{ url('storage/files/' . $item->content) }}" class="w-100">
                                @break

                                    @default
                                @endswitch
                            </div>
                            <div class="col-9 pe-0">
                                {{ $item->child_index ?? $item->name }}
                            </div>
                            <div class="col px-0">
                                <h1 class="avatar-sm">
                                    <span class="avatar-title bg-light text-dark rounded">
                                        <i class="fa fa-download font-16"></i>
                                    </span>
                                </h1>
                            </div>
                        </div> <!-- end row -->
                    </a>
                </div> <!-- end .p-2-->
            </div> <!-- end col -->
        </div> <!-- end col-->
    @endforeach









</div>
