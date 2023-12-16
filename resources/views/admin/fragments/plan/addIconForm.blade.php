<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Icone de Plano') }}</h4>

        <form action="{{ route('web.admin.settings.plan.update.icon.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $plan->id }}">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Selecione o icone') }}</label>
                <input type="file" name="icon" required class="form-control">
            </div> 

            <div class="col-md-12">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
