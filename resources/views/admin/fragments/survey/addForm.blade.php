<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Inquerito') }}</h4>

        <form action="{{ route('web.admin.project.survey.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-6 mb-3">
                <label for="course_id" class="form-label">{{ __('Curso') }}</label>
                <select name="course_id" class="form-control">
                    @foreach ($course as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="project_id" class="form-label">{{ __('Projecto') }}</label>
                <select name="survey_category_id" class="form-control">
                    @foreach ($survey_category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">{{ __('Data de Inicio') }}</label>
                <input type="date" name="start_date" id="start_date" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">{{ __('Data de Termino') }}</label>
                <input type="date" name="end_date" id="end_date" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome...') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="language_id" class="form-label">{{ __('Idioma') }}</label>
                <select name="language_id" class="form-control">
                    @foreach ($language as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">{{ __('Descricao') }}</label>
                <textarea name="description" class="w-100 form-control" rows="5"></textarea>
            </div>

            <div class="col-md-12">
                <h4 class="row">
                    <div class="col-6">
                        {{ __('Datos personales requeridos') }} </div>
                    <div class="col-6 text-end">
                        <button type="button" role="button" to="#cities" elem-target="#jop_cities"
                            class="clonehim btn btn btn-primary float-right chl_loader"><i
                                class="fa fa-plus"></i></button>
                    </div>
                </h4>
                <hr>
                <div id="cities">

                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>


<div class="d-none" id="jop_cities">
    <div class="im_dad row">
        <div class="col-12 text-end">
            <button class="btn btn-primary rm_dad" type="button"><i class="fa fa-trash"></i></button>

        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">{{ __('Dado') }}</label>
                <input type="text" class="form-control" name="person_data_name[]">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">{{ __('Tipo de Dado') }}</label>
                <select class="form-control" name="person_data_type[]">
                    <option value="text">Texto</option>
                    <option value="rich_text">Texto Rico</option>
                    <option value="boolean">Verdadeiro/Falso</option>
                    <option value="number">Numero</option>
                    <option value="int_number">Numero Inteiro</option>
                    <option value="date">Data</option>
                    <option value="day">Dia</option>
                    <option value="month">Mes</option>
                    <option value="year">Ano</option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="dropdown-divider mt-3"></div>
        </div>

    </div>
</div>
