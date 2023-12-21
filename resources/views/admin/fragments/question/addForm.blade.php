<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Usuario') }}</h4>

        <form action="{{ route('web.admin.question.add.do') }}" class="form_ parent-load row" method="post">


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icona Color') }}</label>
                <input type="text" name="icon iconpicker" class="form-control hex_color">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icona') }}</label>
                <input type="text" name="icon_file" class="form-control iconpicker">
            </div>


            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" class="form-control">
            </div>


            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>
