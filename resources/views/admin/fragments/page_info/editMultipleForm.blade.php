<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Configuracion') }}</h4>

        <form action="{{ route('web.admin.page.page_info.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $page_info->id }}">
            <div class="col-md-12 mb-3">
                <output type="text" name="name" id="name"
                    class="form-control fs-20">{{ $page_info->name }}</output>
            </div>

            @foreach ($page_info->children as $item)
                <div class="{{ $item->content_type == 'file' ? 'col-md-4' : 'col-md-12' }} mb-3 im_dad">
                    <div class="w-100"> <button type="button" role="button"
                            class="rm_dad btn rounded-0 btn-md float-end"><i class="fa fa-trash"></i></button></div>
                    @switch($item->content_type)
                        @case('rich_text')
                            <textarea name="content[{{ Flores\Tools::encode($item->id, 1) }}]" class="w-100 textareaI"
                                rows="{{ $item->line_height ?? 3 }}">{!! $item->content !!}</textarea>
                        @break

                        @case('plain_text')
                            @if ($page_info->line_height <= 1)
                                <input name="content" class="w-100" value="{!! $page_info->content !!}" />
                            @else
                                <textarea name="content" class="w-100" rows="{{ $page_info->line_height ?? 3 }}">{!! $page_info->content !!}</textarea>
                            @endif
                        @break

                        @case('number')
                            <input class="form-control" type="text" name="content[{{ Flores\Tools::encode($item->id, 1) }}]"
                                value="{!! $item->content !!}">
                        @break

                        @case('file')
                        <input type="hidden" name="keep[]" value="{{ $item->id }}">
                            @php
                                $file = fileman(storage_path('files/' . $item->content));
                            @endphp
                            @if ($file->isImage())
                                <img src="{{ url('storage/files/' . $item->content) }}" class="w-100">
                            @elseif($file->isVideo())
                                <video src="{{ url('storage/files/' . $item->content) }}" class="w-100"></video>
                            @endif
                        @break

                    </div>

                    @default
                @endswitch
    </div>
    @endforeach


    <div class="col-md-12">
        <h4 class="row">
            <div class="col-6">
                {{ __('Mais') }} </div>
            <div class="col-6 text-end">
                <button type="button" role="button" to="#cities" elem-target="#jop_cities"
                    class="clonehim btn btn btn-primary float-right chl_loader"><i class="fa fa-plus"></i></button>
            </div>
        </h4>
        <hr>
        <div id="cities">

        </div>
    </div>


    <div class="col-md-3">

        <button type="submit" class="btn btn-secondary chl_loader"><i
                class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
    </div>
    </form>

</div> <!-- end card-body -->
</div>





<div class="d-none" id="jop_cities">
    <div class="im_dad row">
        <div class="col-12 text-end">
            <button class="btn btn-primary rm_dad" type="button"><i class="fa fa-trash"></i></button>

        </div>
        <div class="col-12">


            <div class="form-group">

                @switch($page_info->content_type)
                    @case('rich_text')
                        <textarea name="content[]" class="w-100 textarea" rows="5"></textarea>
                    @break

                    @case('plain_text')
                        <textarea name="content[]" class="w-100" rows="5"></textarea>
                    @break

                    @case('number')
                        <input class="form-control" type="text" name="content[]" value="">
                    @break

                    @case('file')
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">{{ __('Arquivo') }}</label>
                                <input type="file" {!! empty($page_info->filetypes) ? '' : 'accept="' . $page_info->filetypes . '"' !!} class="form-control" name="content[]">
                            </div>
                        </div>
                    @break

                    @default
                @endswitch

            </div>














        </div>
        <div class="col-12">
            <div class="dropdown-divider mt-3"></div>
        </div>


    </div>
</div>
