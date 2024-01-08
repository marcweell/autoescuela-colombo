<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Usuario') }}</h4>

        <form action="{{ route('web.admin.user.add.do') }}" class="form_" method="post">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Apellido paterno</label>
                    <input type="text" class="form-control" name="father_name" value="">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Apellido materno</label>
                    <input type="text" class="form-control" name="mother_name" value="">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">{{ __('Nombres') }}</label>
                    <input type="text" name="name" required id="name" class="form-control"
                        placeholder="{{ __('Ingrese nombre...') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="code" class="form-label">{{ __('Nombre de Usuario') }}</label>
                    <input type="text" name="code" id="code" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="text" name="email" id="email" required class="form-control"
                        placeholder="{{ __('Ingrese Email...') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">{{ __('Teléfono') }}</label>
                    <div class="input-group">
                        <select class="form-control w-25 " required style="width: 25%" name="idd_country_id">
                            @foreach ($country as $item)
                                <option {{ strtolower($item->code) == 'bo' ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->idd . "({$item->name})" }}</option>
                            @endforeach
                        </select>
                        <input type="text" required class="form-control w-75" placeholder="" aria-label=""
                            aria-describedby="basic-addon1" name="phone" value="">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">{{ __('Contrasena') }}</label>
                    <div class="input-group">
                        <input type="password" id="pwd" class="form-control" name="password">
                        <div class="input-group-append">
                            <button id="togglePassword" class="btn btn-dark btn-lg rounded-0" type="button"><i
                                    class="fa fa-eye"></i></button>
                        </div>
                    </div>
                </div>



                <div class="col-md-4 mb-3">
                    <label for="type" class="form-label">{{ __('Tipo de Usuario') }}</label>
                    <select name="type" id="user_type" required class="form-control ">
                        <option>Seleccione el tipo de usuario</option>
                        <option value="user">Alumno</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3" style="display: none">
                    <label for="type" class="form-label">{{ __('Nivel de Usuario') }}</label>
                    <select name="role_id" id="role_id" required class="form-control ">
                        <option>Seleccione el nivel</option>
                        @foreach ($role as $item)
                            <option value="{{ $item->name }}">{{ $item->id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>





            <div class="row" style="display: none" id="user-container">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">Curso</label>
                    <select class="form-control " name="course_id">
                        @foreach ($course as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label">Carnet de Identidad</label>
                    <input type="text" class="form-control" name="national_id" value="">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="born_date" value="">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Pais</label>
                    <select class="form-control " name="country_id">
                        @foreach ($country as $item)
                            <option value="{{ $item->id }}"
                                {{ strtolower($item->code) == 'bo' ? 'selected' : '' }}>
                                {{ $item->name . ' (' . $item->native_name . ')' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">Direccion</label>
                    <input type="text" name="address" cols="3" class="form-control" />
                </div>
            </div>






















            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="active" class="form-check-input" id="customCheck3">
                        <label class="form-check-label" for="customCheck3">Activo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="send-auth" class="form-check-input" id="customCheck4">
                        <label class="form-check-label" for="customCheck4">Enviar correo electrónico de
                            autenticación</label>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>


<script>
    $('#user_type').on('change', function() {

        var val = $(this).val();
        $("#role_id").val("");

        switch (val) {
            case 'user':
                $("#user-container").show();
                $("#role_id").hide();
                break;
            default:
                $("#role_id").show();
                $("#user-container").hide();
                break;
        }



    });
</script>
