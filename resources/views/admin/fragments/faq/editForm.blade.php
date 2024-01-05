<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Pergunta Frequente') }}</h4>

        <form action="{{ route('web.admin.settings.faq.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $faq->id }}">
            <div class="col-md-6 mb-3">
                <label for="language_id" class="form-label">{{ __('Idioma') }}</label>
                <select name="language_id" class="form-control">
                    @foreach ($language as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Pergunta') }}</label>
                <input type="text" name="title" id="name" class="form-control" value="{{  $faq->title }}">
            </div>

            <div class="col-md-12 mb-3">
                <label for="title" class="form-label">{{ __('Resposta') }}</label>
                <textarea name="description" class="form-control textarea" rows="10">{!! $faq->description !!}</textarea>
            </div>

            <button type="submit" class="btn btn-secondary chl_loader"><i class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
        </form>

    </div> <!-- end card-body -->
</div>
