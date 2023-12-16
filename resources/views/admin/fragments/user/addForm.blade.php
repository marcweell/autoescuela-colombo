<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Usuario') }}</h4>

        <form action="{{ route('web.admin.user.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Apelido') }}</label>
                <input type="text" name="last_name" id="last_name" class="form-control"
                    placeholder="{{ __('Digite o Apelido...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="balance" class="form-label">{{ __('Saldo Inicial do Carteira') }}</label>
                <input type="number" name="balance" id="balance" class="form-control">
            </div>
            <div class="col-md-8 mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="text" name="email" id="email" class="form-control"
                    placeholder="{{ __('Digite o Email...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="phone" class="form-label">{{ __('Telefone') }}</label>
                <div class="input-group">
                    <select class="form-control w-25" style="width: 25%" name="idd_country_id">
                        @foreach ($country as $item)
                            <option value="{{ $item->id }}" {{ (strtolower($item->code)=="br")?"selected":"" }}>{{ $item->idd . "     (".$item->name." - ".$item->native_name.")" }}</option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control w-75" placeholder="" aria-label=""
                        aria-describedby="basic-addon1" name="phone" value="">
                </div>
            </div> 

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nome de Usuario') }}</label>
                <input type="text" name="code" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome de usuario...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Senha') }}</label>
                <input type="text" name="password" id="last_name" class="form-control"
                    placeholder="{{ __('Digite uma senha inicial...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nivel') }}</label>
                <select name="level" id="level" class="form-control">
                    @for ($i = 1; $i < 100; $i++) 
                        <option value="{{$i}}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
           

            <div class="col-md-8 mb-3">
                <label for="type" class="form-label">{{ __('Tipo') }}</label>
                <select name="type" class="form-control">
                    <option value="user">Usuario Padrao</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input checked type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Activo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input checked type="checkbox" name="send-auth" class="form-check-input" id="customCheck4">
                    <label class="form-check-label" for="customCheck4">Enviar Email de Autenticacao</label>
                </div>
            </div> 
            <div class="col-md-12 mb-3">
                <label for="indicator_id" class="form-label">{{ __('Indicador') }}</label>
                <select name="indicator_id" class="form-control select2">
                    @foreach($users as $i => $item)
                    <option value="{{ $item->id }}">{{ $item->full_name.'- '.$item->code }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>

 