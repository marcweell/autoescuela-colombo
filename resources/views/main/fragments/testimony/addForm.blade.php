<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Depoimento') }}</h4>

        <form action="{{ route('web.app.testimony.add.do') }}" class="form_ parent-load-- row" method="post">

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Estrelas') }}</label>
                <select name="points" class="form-control">
                    @for ($i = 0; $i < 6; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Mensagem') }}</label>
                <textarea name="message" class="form-control" rows="5"></textarea>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-dark chl_loader--"><i
                        class="fa fa-send p-1"></i>{{ __('Enviar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
