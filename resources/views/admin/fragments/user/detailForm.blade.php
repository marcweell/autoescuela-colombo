<div class="card">

    <div class="card-body">
            <input type="hidden" name="id" value="{{ $user->id }}">

            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Apellido paterno') }}</label>
                <input type="text" name="father_name" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Apellido materno') }}</label>
                <input type="text" name="mother_name" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombres') }}</label>
                <input type="text" name="names" required id="name" class="form-control" value="{{ $user->names }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="balance" class="form-label">{{ __('Carnet de Identidad') }}</label>
                <input type="text" name="national_id" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Edad') }}</label>
                <input type="date" name="born_date" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Celular') }}</label>
                <input type="text" name="phone" id="email" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Correo') }}</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">{{ __('Categoria') }}</label>
                <select name="question_category" class="form-control">
                    @foreach ($question_category ?? [] as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="curso" class="form-label">Curso de conduccion</label>
                <select class="form-select" name="curso" id="curso">
                    <option value="">Selecciona un curso</option>
                    <option value="1">Curso basico</option>
                    <option value="2">Curso de perfeccionamiento</option>
                    <option value="3">Curso especializado para el examen</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="formulario" class="form-label">Tipo de formulario</label>
                <select class="form-select" name="form_type" id="formulario">
                    <option value="">Selecciona tipo de formulario</option>
                    <option value="1">Inscripcion</option>
                    <option value="2">Examen</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">{{ __('Nivel de usuario') }}</label>
                <select name="type" class="form-control">
                    <option value="">Selecciona nivel usuario</option>
                    <option value="administrador">Administrador</option>
                    <option value="secretaria">Secretaria</option>
                    <option value="usuario">Usuario</option>
                    <option value="prueba">Prueba</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">{{ __('Contraseña') }}</label>
                <input type="text" name="password" id="last_name" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Pdf carnet ambas caras') }}</label>
                <input type="file" name="ss" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Pdf evaluacion médica ambas caras') }}</label>
                <input type="file" name="ss" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">{{ __('Foto') }}</label>
                <input type="file" name="ss" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input checked type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Activo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input checked type="checkbox" name="send-auth" class="form-check-input" id="customCheck4">
                    <label class="form-check-label" for="customCheck4">Enviar Email de Autenticacao</label>
                </div>
            </div>

    </div> <!-- end card-body -->
</div>
