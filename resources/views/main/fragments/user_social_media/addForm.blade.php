<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Rede Social de Usuario') }}</h4>

        <form action="{{ route('web.app.user_social_media.add.do') }}" class="form_ parent-load-- row" method="post">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Rede Social') }}</label>
                <select name="social_media_id" id="social_media_id" class="form-control">
                    @foreach ($social_media as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Identificador') }}</label>
                <input type="text" name="profile_id" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome de usuario ou numero...') }}">
            </div>


            <div class="col-md-12">
                <button type="submit" class="btn btn-dark  chl_loader--"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
