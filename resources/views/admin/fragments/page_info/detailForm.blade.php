<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ $page_info->name }}</h4>
            <hr>
            <div class="d-block border-1 im_dad">
                @if ($page_info->content_type == 'file')
                    <a href="{{ url('storage/files/' . $page_info->content) }}">Baixar</a>
                @else
                    {!! $page_info->content !!}
                @endif
            </div>
 
    </div> <!-- end card-body -->
</div>
