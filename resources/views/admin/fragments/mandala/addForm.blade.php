<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Matriz') }}</h4>

        <form action="{{ route('web.admin.mandala.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" id="name" class="form-control"
                    placeholder="{{ __('Caso deixe em branco, um nome sera gerado') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Plano') }}</label>
                <select name="plan_id" id="plan_id" class="form-control">
                    @foreach ($plan as $item)
                        <option value="{{ $item->id }}">{{ $item->name.' - '.$item->currency_symbol . format_number($item->price ?? 0) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="title" class="form-label">{{ __('Descricao') }}</label>
                <textarea name="description" class="form-control textarea" rows="10"></textarea>
            </div> 


            <div class="col-md-12">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
