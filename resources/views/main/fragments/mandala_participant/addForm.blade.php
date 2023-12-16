<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Aderir ao Giro') }}</h4>

        <form action="{{ route('web.app.mandala.participant.add.do') }}" class="form_ parent-load-- row" method="post">
            <input type="hidden" name="mandala_id" value="{{ $mandala->id }}">

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Selecione um indicador') }}</label>
                <select name="participant_id" id="user_id" class="form-control">
                    @foreach ($participant as $item)
                        <option value="{{ $item->id }}">{{ $item->user_full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-dark  chl_loader--"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
