<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Agregar Categoría de página') }}</h4>

        <form action="{{ route('web.admin.page.category.add.do') }}" class="form_ parent-load row" method="post">


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icono Color') }}</label>
                <input type="text" name="icon_hex_color" class="form-control hex_color">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icono') }}</label>
                <input type="text" name="icon" class="form-control iconpicker">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" class="form-control">
            </div>


            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">{{ __('Descripcion') }}</label>
                <textarea type="text" name="description" class="form-control" rows=3></textarea>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input checked type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Activo</label>
                </div>
            </div>

            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>
