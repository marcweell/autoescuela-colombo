<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ $page_info->name }}</h4>

        @foreach ($page_info->children as $item)

            <hr>
            <div class="d-block border-1 im_dad">
                @if ($item->content_type == 'file')
                    <a href="{{ url('storage/files/' . $item->content) }}">{{ $item->child_index??$item->name }}</a>
                @else
                    {!! $item->content !!}
                @endif
            </div>

        @endforeach

    </div> <!-- end card-body -->
</div>
