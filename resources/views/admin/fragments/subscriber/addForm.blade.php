<div class="card">
    
    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Subscritor') }}</h4>

        <form action="{{ route('web.admin.subscriber.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Email') }}</label>
                <input type="text" name="email" id="name" class="form-control" placeholder="{{ __('Digite o nome...') }}">
            </div>
            
<div class="col-12 pr-5">
    <button type="submit" class="btn btn-secondary chl_loader"><i class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
</div>
        </form>

    </div> <!-- end card-body -->
</div>
