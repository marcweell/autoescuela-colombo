<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">

                <h4 class="header-title">{{ __('Alterar Senha') }}</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('web.admin.profile.password.update.do') }}" class="form_ parent-load row prompt"
                    method="post">
                    <div class="col-md-12 mb-3">
                        <label for="password" class="form-label">{{ __('Senha Antiga') }}</label>
                        <input name="old_password" type="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">{{ __('Nova Senha') }}</label>
                        <input name="password" type="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">{{ __('Digite a nova senha novamente') }}</label>
                        <input name="confirm_password" type="password" class="form-control">
                    </div>
                    <div class="col-12">


                        <button type="submit" class="btn btn-secondary chl_loader"><i
                                class="fa fa-save p-2"></i>{{ __('Confirmar') }}</button>

                        <button data-href="{{ route('web.admin.profile.index') }}" class="btn btn-primary _link_"><i
                                class="fa fa-arrow-left p-2"></i> Voltar ao Perfil</button>
                    </div>
                </form>

            </div> <!-- end card-body -->
        </div>
    </div>
</div>
