<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Servicios') }}</h4>

        <form action="{{ route('web.admin.page.services.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Icone') }}</label>
                <input type="text" name="icon" id="name" class="form-control iconpicker"  autocomplete="off">
            </div>
            <div class="col-12">
                <textarea name="description" class="w-100" rows="7"></textarea>
            </div>

            <div class="col-12 pr-5">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
