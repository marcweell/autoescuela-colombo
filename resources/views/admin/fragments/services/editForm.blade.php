<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Serviços') }}</h4>

        <form action="{{ route('web.admin.page.services.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $services->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" id="name" class="form-control" value="{{  $services->name }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="fa_icon" class="form-label">{{ __('Icone') }}</label>
                <input type="text" name="fa_icon" id="fa_icon" class="form-control" value="{{  $services->fa_icon }}">
            </div>

            <div class="col-12">
                <textarea name="description" class="w-100" rows="7">{{  $services->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('guardar') }}</button>
        </form>

    </div> <!-- end card-body -->
</div>
