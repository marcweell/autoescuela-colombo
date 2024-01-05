<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Parceiro') }}</h4>

        <form action="{{ route('web.admin.page.partner.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Capa') }}</label>
                <input type="file" name="attach" id="name" class="form-control">
            </div>
            <div class="col-12">
                <textarea name="description" class="w-100" rows="7"></textarea>
            </div>

            <div class="col-12 pr-5">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
