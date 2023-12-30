<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ $page_info->name }}</h4>
        <hr>
        <div class="d-block border-1 im_dad">
            @if ($page_info->content_type == 'file')

                <a class="btn btn-lg" target="_blank" href="{{ url('storage/files/' . $page_info->content) }}">Descargar <i
                        class="fa fa-download"></i></a>

                @php
                    $file = fileman(storage_path('files/' . $page_info->content));
                @endphp
                <div class="row">
                    <div class="col-lg-3 col-md-6">

                        @if ($file->isImage())
                            <img src="{{ url('storage/files/' . $page_info->content) }}" class="w-100">
                        @elseif($file->isVideo())
                            <video src="{{ url('storage/files/' . $page_info->content) }}" class="w-100"></video>
                        @endif
                    </div>
                </div>
            @else
                {!! $page_info->content !!}
            @endif
        </div>

    </div> <!-- end card-body -->
</div>
