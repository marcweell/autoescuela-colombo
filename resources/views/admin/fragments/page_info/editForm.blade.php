<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Configuracion') }}</h4>

        <form action="{{ route('web.admin.page_info.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $page_info->id }}">
            <div class="col-md-12 mb-3">
                <output type="text" name="name" id="name"
                    class="form-control border-0 fs-20">{{ $page_info->name }}</output>
            </div>
            <div class="col-md-12 mb-3">
                @switch($page_info->content_type)
                    @case('rich_text')
                        <textarea name="content" class="w-100 textarea" rows="{{ $page_info->line_height ?? 3 }}">{!! $page_info->content !!}</textarea>
                    @break

                    @case('plain_text')
                        <textarea name="content" class="w-100" rows="{{ $page_info->line_height ?? 3 }}">{!! $page_info->content !!}</textarea>
                    @break

                    @case('number')
                        <input class="form-control" type="text" name="content" value="{!! $page_info->content !!}">
                    @break

                    @case('file')
                        <input class="form-control" type="file" {!! empty($page_info->filetypes) ? '' : 'accept="' . $page_info->filetypes . '"' !!} name="content">
                    @break

                    @default
                @endswitch
            </div>

            <div class="col-md-3">

                <button type="submit" class="btn btn-secondary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
