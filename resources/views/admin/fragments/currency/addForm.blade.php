<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Moneda') }}</h4>

        <form action="{{ route('web.admin.settings.currency.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Ingrese nome...') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Simbolo') }}</label>
                <input type="text" name="symbol" id="name" class="form-control"
                    placeholder="{{ __('Ingrese simobolo...') }}">
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
