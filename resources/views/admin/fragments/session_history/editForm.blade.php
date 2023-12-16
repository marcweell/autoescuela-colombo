<div class="card">
    
    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Pais') }}</h4>

        <form action="{{ route('web.admin.auditory.session_history.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $session_history->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control" value="{{  $session_history->name }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="code" id="code" class="form-control" value="{{  $session_history->code }}">
            </div>
            
            
<div class="col-md-12">
    <button type="submit" class="btn btn-secondary  chl_loader"><i class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
</div> 
        </form>

    </div> <!-- end card-body -->
</div>
