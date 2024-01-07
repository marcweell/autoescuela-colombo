<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">

                <h4 class="header-title">{{ __('Cambiar contraseña') }}</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('web.admin.profile.password.update.do') }}" class="form_ parent-load row prompt"
                    method="post">
                    <div class="col-md-12 mb-3">
                        <label for="password" class="form-label">{{ __('Contraseña anterior') }}</label>
                        <input name="old_password" type="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">{{ __('Nueva contraseña') }}</label>
                        <input name="password" type="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">{{ __('Ingrese la nueva contraseña nuevamente') }}</label>
                        <input name="confirm_password" type="password" class="form-control">
                    </div>
                    <div class="col-12">


                        <button type="submit" class="btn btn-primary chl_loader"><i
                                class="fa fa-save p-2"></i>{{ __('Confirmar') }}</button>

                        <button data-href="{{ route('web.admin.profile.index') }}" class="btn btn-primary _link_"><i
                                class="fa fa-arrow-left p-2"></i>Volver al perfil</button>
                    </div>
                </form>

            </div> <!-- end card-body -->
        </div>
    </div>
</div>
