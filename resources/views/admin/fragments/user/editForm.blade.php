<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Usuario') }}</h4>

        <form action="{{ route('web.admin.user.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    value="{{ $user->name }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Apelido') }}</label>
                <input type="text" name="last_name" id="last_name" class="form-control"
                    value="{{ $user->last_name }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="text" name="email" id="email" class="form-control"
                    placeholder="{{ __('Digite o Email...') }}" value="{{ $user->email }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="phone" class="form-label">{{ __('Telefone') }}</label>
                <div class="input-group">
                    <select class="form-control w-25" style="width: 25%" name="idd_country_id">
                        @foreach ($country as $item)
                            <option value="{{ $item->id }}" {{ strtolower($item->code) == 'br' ? 'selected' : '' }}>
                                {{ $item->idd . '     (' . $item->name . ' - ' . $item->native_name . ')' }}</option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control w-75" placeholder="" aria-label=""
                        aria-describedby="basic-addon1" name="phone" value="{{ $user->phone }}">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">{{ __('Tipo') }}</label>
                <select name="type" class="form-control">
                    <option {{ "user" == $user->type?'selected' : '' }} value="user">Usuario Padrao</option>
                    <option {{ "admin" == $user->type?'selected' : '' }} value="admin">Admin</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">{{ __('Nivel') }}</label>
                <select name="level" class="form-control">
                    @for ($i = 1; $i < 100; $i++)
                        
                    <option {{ $i == $user->level?'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input {{ $user->active == true ? "checked" : "" }} type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Conta Ativa</label>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input {{ $user->canjoin == true ? "checked" : "" }} type="checkbox" name="canjoin" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Ativo para adesao</label>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="indicator_id" class="form-label">{{ __('Indicador') }}</label>
                <select name="indicator_id" class="form-control select2">
                    @foreach($users as $i => $item)
                    <option {{ $item->id == $user->indicator_id?'selected' : '' }} value="{{ $item->id }}">{{ $item->full_name.'- '.$item->code }}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-12">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
