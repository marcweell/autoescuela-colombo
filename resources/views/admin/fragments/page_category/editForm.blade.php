<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Usuario') }}</h4>

        <form action="{{ route('web.admin.page.category.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $page_category->id }}">

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icona Color') }}</label>
                <input type="text" name="icon_hex_color" class="form-control hex_color" value="{{ $page_category->icon_hex_color }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icono') }}</label>
                <input type="file" name="icon_file" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" class="form-control" value="{{ $page_category->name }}">
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input {{ $page_category->active == true ? 'checked' : '' }} type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Activo</label>
                </div>
            </div>



            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>
