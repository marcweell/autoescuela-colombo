<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Usuario') }}</h4>

        <form action="{{ route('web.admin.user.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $user->id }}">

            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Apellido paterno') }}</label>
                <input type="text" name="father_name" class="form-control" value="{{ $user->father_name }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Apellido materno') }}</label>
                <input type="text" name="mother_name" class="form-control" value="{{ $user->mother_name }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombres') }}</label>
                <input type="text" name="names" required id="name" class="form-control" value="{{ $user->names }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="balance" class="form-label">{{ __('Carnet de Identidad') }}</label>
                <input type="text" name="national_id" class="form-control" value="{{ $user->national_id }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Edad') }}</label>
                <input type="date" name="born_date" class="form-control" value="{{ $user->born_date }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Celular') }}</label>
                <input type="text" name="phone" id="email" class="form-control" value="{{ $user->phone }}">
            </div>

            <div class="col-md-8 mb-3">
                <label for="email" class="form-label">{{ __('Correo') }}</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">{{ __('Categoria') }}</label>
                <select name="question_category_id" class="form-control">
                    @foreach ($question_category ?? [] as $item)
                        <option {{$user->question_category_id == $item->id ? "selected":"" }} value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="curso" class="form-label">Curso de conduccion</label>
                <select class="form-select" name="driving_course" id="curso">
                    <option   value="">Selecciona un curso</option>
                    <option {{$user->driving_course == 1 ? "selected":"" }}  value="1">Curso basico</option>
                    <option {{$user->driving_course == 2 ? "selected":"" }}  value="2">Curso de perfeccionamiento</option>
                    <option {{$user->driving_course == 3 ? "selected":"" }}  value="3">Curso especializado para el examen</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="formulario" class="form-label">Tipo de formulario</label>
                <select class="form-select" name="form_type" id="formulario">
                    <option   value="">Selecciona tipo de formulario</option>
                    <option {{$user->question_category_id == $item->id ? "selected":"" }}  value="1">Inscripcion</option>
                    <option {{$user->question_category_id == $item->id ? "selected":"" }}  value="2">Examen</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">{{ __('Nivel de usuario') }}</label>
                <select name="type" class="form-control">
                    <option   value="">Selecciona nivel usuario</option>
                    <option {{$user->type == "administrador" ? "selected":"" }}  value="administrador">Administrador</option>
                    <option {{$user->type == "secretaria" ? "selected":"" }}  value="secretaria">Secretaria</option>
                    <option {{$user->type == "usuario" ? "selected":"" }}  value="usuario">Usuario</option>
                    <option {{$user->type == "prueba" ? "selected":"" }}  value="prueba">Prueba</option>
                </select>
            </div>



            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Pdf carnet ambas caras') }}</label>
                <input type="file" name="passport_file" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Pdf evaluacion médica ambas caras') }}</label>
                <input type="file" name="medical_evaluation_file" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Foto') }}</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input checked type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label {{$user->active == true ? "checked":"" }}   class="form-check-label" for="customCheck3">Activo</label>
                </div>
            </div>

            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>
