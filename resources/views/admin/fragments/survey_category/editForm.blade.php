<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Categoria de Examen') }}</h4>

        <form action="{{ route('web.admin.settings.survey_category.update.do') }}" class="form_ parent-load row"
            method="post">
            <input type="hidden" name="id" value="{{ $survey_category->id }}">
            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    value="{{ $survey_category->name }}">
            </div>


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preguntas Transito') }}</label>
                <input type="text" name="traffic_question" class="form-control"
                    value="{{ $survey_category->traffic_question }}">
            </div>


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preguntas Transito Corretas') }}</label>
                <input type="text" name="traffic_question_corrects" class="form-control"
                    value="{{ $survey_category->traffic_question_corrects }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preguntas Mecanica') }}</label>
                <input type="text" name="mechanics_question" class="form-control"
                    value="{{ $survey_category->mechanics_question }}">
            </div>


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preguntas Mecanica Corretas') }}</label>
                <input type="text" name="mechanics_question_corrects" class="form-control"
                    value="{{ $survey_category->mechanics_question_corrects }}">
            </div>


            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Tiempo Minutos') }}</label>
                <input type="number" name="time_minute" class="form-control"
                    value="{{ $survey_category->time_minute }}">
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input {{ $survey_category->active == true ? 'checked' : '' }} type="checkbox" name="active"
                        class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Activo</label>
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
