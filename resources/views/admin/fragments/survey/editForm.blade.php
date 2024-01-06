<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Examen') }}</h4>

        <form action="{{ route('web.admin.survey.survey.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $survey->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control" value="{{  $survey->name }}">
            </div>
            @foreach ($data as $item)

            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">{{ __($item->name) }}</label>
                <input type="{{ $item->data_type }}" name="{{ $item->code }}" class="form-control" value="">
            </div>

            @endforeach

<div class="col-md-12">
    <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
</div>
        </form>

    </div> <!-- end card-body -->
</div>
