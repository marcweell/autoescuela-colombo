<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Categoria de Examen') }}</h4>

        <form action="{{ route('web.admin.settings.survey_category.add.do') }}" class="form_ parent-load row"
            method="post">

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Ingrese nombre...') }}">
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
