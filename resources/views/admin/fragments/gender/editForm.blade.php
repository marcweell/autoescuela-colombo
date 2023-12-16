<div class="card">
    
    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Genero') }}</h4>

        <form action="{{ route('web.admin.settings.gender.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $gender->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control" value="{{  $gender->name }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="code" id="code" class="form-control" value="{{  $gender->code }}">
            </div>
            
            
<div class="col-md-12">
    <button type="submit" class="btn btn-secondary chl_loader"><i class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
</div> 
        </form>

    </div> <!-- end card-body -->
</div>
