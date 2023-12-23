<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Agregar Categoría de pregunta') }}</h4>

        <form action="{{ route('web.admin.question.category.add.do') }}" class="form_ parent-load row" method="post">


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icona Color') }}</label>
                <input type="text" name="icon_hex_color" class="form-control hex_color">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icona') }}</label>
                <input type="file" name="icon_file" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" class="form-control">
            </div>


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preguntas Transito') }}</label>
                <input type="text" name="traffic_question" class="form-control">
            </div>


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preguntas Transito Corretas') }}</label>
                <input type="text" name="traffic_question_corrects" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preguntas Mecanica') }}</label>
                <input type="text" name="mechanics_question" class="form-control">
            </div>


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preguntas Mecanica Corretas') }}</label>
                <input type="text" name="mechanics_question_corrects" class="form-control">
            </div>


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Tiempo Minutos') }}</label>
                <input type="text" name="time_minute" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input checked type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Activo</label>
                </div>
            </div>

            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>
