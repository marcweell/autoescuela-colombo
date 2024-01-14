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
                    <label for="email" class="form-label">{{ __('Correo') }}</label>
                    <input type="text" name="email" id="email" required class="form-control"
                        placeholder="{{ __('Ingrese Email...') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">{{ __('Celular') }}</label>
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
                            <button id="togglePassword" class="btn btn-dark rounded-0" type="button"><i
                                    class="fa fa-eye"></i></button>
                        </div>
                    </div>
                </div>



                <div class="col-md-4 mb-3">
                    <label for="type" class="form-label">{{ __('Tipo de Usuario') }}</label>
                    <select name="type" id="user_type" required class="form-control ">
                        <option value="">Seleccione el tipo de usuario</option>
                        <option value="user">Alumno</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3" style="display: none" id="role_container">
                    <label for="type" class="form-label">{{ __('Nivel de Usuario') }}</label>
                    <select name="role_id" id="role_id" class="form-control ">
                        <option>Seleccione el nivel</option>
                        @foreach ($role as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>





            <div class="row" style="display: none" id="user-container">

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Categoria Examen</label>
                    <select class="form-control " name="survey_category_id">
                        @foreach ($survey_category ?? [] as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-4 mb-3">
                    <label class="form-label">Categoria</label>
                    <select class="form-control " name="course_category_id" id="course_category_id">
                        @foreach ($course_category ?? [] as $item)
                            <option data-courses="{{ $item->courses }}" value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-4 mb-3">
                    <label class="form-label">Curso</label>
                    <select class="form-control " name="course_id" id="course_id">
                    </select>
                </div>


                <div class="col-md-4 mb-3">
                    <label for="form_type" class="form-label">{{ __('Tipo de Formulario') }}</label>
                    <select name="form_type" required class="form-control ">
                        <option value="">Seleccione el tipo de usuario</option>
                        <option value="examen">Examen</option>
                        <option value="inscription">Inscription</option>
                    </select>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label">Carnet de Identidad</label>
                    <input type="text" class="form-control" name="national_id" value="">
                </div>


                <div class="col-md-4 mb-3">
                    <label class="form-label">Edad</label>
                    <input type="number" step="1" class="form-control" name="age" value="">
                </div>


                <div class="col-md-4 mb-3">
                    <label class="form-label">Direccion</label>
                    <input type="text" name="address" cols="3" class="form-control" />
                </div>


                <div class="col-md-4 mb-3">
                    <label class="form-label">PDF Evaluacion Medica Ambas Caras</label>
                    <input type="file" class="form-control" name="medical_evaluation_file">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">PDF Carnet Ambas Caras</label>
                    <input type="file" class="form-control" name="passport_file">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" class="form-control" name="photo">
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
                $("#role_container").hide();
                break;
            default:
                $("#role_container").show();
                $("#user-container").hide();
                break;
        }



    });


    var COURSE = {!! json_encode($course) !!};

    $("#course_category_id").on("change", function() {
        var courses = $('option:selected', this).attr('data-courses');
        courses = courses.replaceAll(" ","");
        courses = courses.split(",");
        $("#course_id").empty();
        for (const value of COURSE) {
            if(!courses.includes(value.id.toString())){
               continue;
            }
            $('#course_id').append($('<option>', {
                value: value.id,
                text: value.name
            }));
        }


    });
</script>
