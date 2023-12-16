<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Cidade') }}</h4>

        <form action="{{ route('web.admin.mandala_invite.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome...') }}">
            </div>

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <select name="plan_id" id="plan_id" class="form-control">
                    @foreach ($plan as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
