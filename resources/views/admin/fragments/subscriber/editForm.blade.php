<div class="card">
    
    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Subscritor') }}</h4>

        <form action="{{ route('web.admin.subscriber.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $subscriber->id }}">
            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">{{ __('Email') }}</label>
                <input type="text" name="email" id="name" class="form-control" value="{{  $subscriber->email }}">
            </div> 

            <button type="submit" class="btn btn-secondary chl_loader"><i class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
        </form>

    </div> <!-- end card-body -->
</div>
