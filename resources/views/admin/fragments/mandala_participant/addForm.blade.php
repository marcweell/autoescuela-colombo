<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Participante') }}</h4>

        <form action="{{ route('web.admin.mandala.participant.add.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="mandala_id" value="{{ $mandala->id }}">

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Selecione um indicador') }}</label>
                <select name="participant_id" id="user_id" class="form-control">
                    @foreach ($participant as $item)
                        <option value="{{ $item->id }}">{{ $item->user_full_name . ' [' . $item->type . ']' }}
                        </option>
                    @endforeach
                </select>
            </div>
            

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Usuario') }}</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($user as $item)
                        @php
                            if (in_array($item->id, $pids)) {
                                continue;
                            }
                            
                        @endphp

                        <option value="{{ $item->id }}">  {{ implode(' ', [$item->name, $item->last_name]) . ' - ' . $item->email }}</option>
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
