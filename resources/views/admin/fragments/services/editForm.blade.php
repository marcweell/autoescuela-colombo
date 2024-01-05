<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Servicios') }}</h4>

        <form action="{{ route('web.admin.page.services.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $services->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" id="name" class="form-control" value="{{  $services->name }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="icon" class="form-label">{{ __('Icone') }}</label>
                <input type="text" name="icon" id="icon" class="form-control iconpicker"  autocomplete="off" value="{{  $services->icon }}">
            </div>

            <div class="col-12">
                <textarea name="description" class="w-100" rows="7">{{  $services->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
        </form>

    </div> <!-- end card-body -->
</div>
