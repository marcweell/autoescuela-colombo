<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Moneda') }}</h4>

        <form action="{{ route('web.admin.settings.currency.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $currency->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control" value="{{  $currency->name }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="symbol" class="form-label">{{ __('Simbolo') }}</label>
                <input type="text" name="symbol" id="symbol" class="form-control" value="{{  $currency->symbol }}">
            </div>


<div class="col-md-12">
    <button type="submit" class="btn btn-secondary  chl_loader"><i class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
</div>
        </form>

    </div> <!-- end card-body -->
</div>
