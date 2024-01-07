<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Usuario') }}</h4>

        <form action="{{ route('web.admin.user.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Ingrese nombre...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Apellido') }}</label>
                <input type="text" name="last_name" id="last_name" class="form-control"
                    placeholder="{{ __('Ingrese Apellido...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="code" class="form-label">{{ __('Nombre de Usuario') }}</label>
                <input type="text" name="code" id="code" class="form-control"
                    placeholder="{{ __('Ingrese nombre de usuario...') }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="text" name="email" id="email" class="form-control"
                    placeholder="{{ __('Ingrese Email...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="phone" class="form-label">{{ __('Teléfono') }}</label>
                <div class="input-group">
                    <select class="form-control w-25" style="width: 25%" name="idd_country_id">
                        @foreach ($country as $item)
                            <option value="{{ $item->id }}">{{ $item->idd . "({$item->name})" }}</option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control w-75" placeholder="" aria-label=""
                        aria-describedby="basic-addon1" name="phone" value="">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">{{ __('Teléfono') }}</label>
                <select name="type" class="form-control">
                    <option value="user">Usuario Padrao</option>
                    <option value="support">Desenvolvedor</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Activo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="send-auth" class="form-check-input" id="customCheck4">
                    <label class="form-check-label" for="customCheck4">Enviar correo electrónico de autenticación</label>
                </div>
            </div>
            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>

