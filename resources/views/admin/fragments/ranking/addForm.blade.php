<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Ranking') }}</h4>

        <form action="{{ route('web.admin.ranking.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-9 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome...') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">{{ __('Maximo de Posicoes') }}</label>
                <input type="number" value="100" name="max_position" required id="name" class="form-control">
            </div>

            <div class="col-md-3 col-6 mb-3">
                <label for="name" class="form-label">{{ __('Data de Inicio') }}</label>
                <input type="date" required name="start_date" value="{{ Date('Y-m-d') }}" required id="name" class="form-control">
            </div>

            <div class="col-md-3 col-6 mb-3">
                <label for="name" class="form-label">{{ __('Hora de Inicio') }}</label>
                <input type="time" required name="start_hour" value="{{ Date('Y-m-d') }}" required id="name" class="form-control">
            </div>

            <div class="col-md-3 col-6 mb-3">
                <label for="name" class="form-label">{{ __('Data de Termino') }}</label>
                <input type="date" required name="end_date" value="{{ Date('Y-m-d') }}" required id="name" class="form-control">
            </div>

            <div class="col-md-3 col-6 mb-3">
                <label for="name" class="form-label">{{ __('Hora de Termino') }}</label>
                <input type="time" required name="end_hour" value="{{ Date('Y-m-d') }}" required id="name" class="form-control">
            </div>


            @php
                $criteria = [
                    'critaria_refering' => 'Usuário que mais cadastrar pessoas diretas a ele desde de a data do início do ranking',
                    'critaria_first_circle_level' => 'Usuário que ciclar primeiro na fase',
                    'critaria_more_circle_level' => 'Usuário que teve mais pessoas da sua equipe completando ciclos e avançando níveis',
                    'include_admin' => 'Incluir Administradores',
                ];
            @endphp

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Criterios') }}</label>
                @foreach ($criteria as $i => $item)
                    <div class="form-check">
                        <input id="{{ $i }}" class="form-check-input" type="checkbox"
                            name="{{ $i }}" id="flexCheck{{ $i }}">
                        <label class="form-check-label" for="flexCheck{{ $i }}">
                            {{ $item }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6 mb-3 critaria_first_circle_level" style="display: none;">
                <label for="name" class="form-label">{{ __('Niveis para primeiro a circlar') }}</label>
                <select name="first_circle_level[]" class="form-control select2" multiple width="100%">
                    @for ($i = $min_level; $i < $max_level + 1; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-6 mb-3 critaria_more_circle_level" style="display: none;">
                <label for="name" class="form-label">{{ __('Niveis para quem teve mais pessoas com ciclos e avanços') }}</label>
                <select name="more_circle_level[]" class="form-control select2" multiple width="100%">
                    @for ($i = $min_level; $i < $max_level + 1; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>



            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Descricao') }}</label>
                <textarea name="description" rows="5" class="form-control"></textarea>
            </div>



            <div class="col-md-12">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>

<script>
    $(function() {
        $('#critaria_first_circle_level').on('change', function() {
            if ($(this).is(':checked')) {
                $('.critaria_first_circle_level').fadeIn();
            } else {
                $('.critaria_first_circle_level').fadeOut();
            }
            app.listenner.listen();
        });

        $('#critaria_more_circle_level').on('change', function() {
            if ($(this).is(':checked')) {
                $('.critaria_more_circle_level').fadeIn();
            } else {
                $('.critaria_more_circle_level').fadeOut();
            }
            app.listenner.listen();
        });
    });
</script>
