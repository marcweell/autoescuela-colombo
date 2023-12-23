<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Agregar Pregunta') }}</h4>

        <form action="{{ route('web.admin.question.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icona') }}</label>
                <input type="text" name="icon_file" class="form-control iconpicker">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Color') }}</label>
                <input type="text" name="color" class="form-control hex_color">
            </div>

            <div class="col-md-4 mb-3">
                <label for="tipologia" class="form-label">General/Curso</label>
                <select class="form-select" name="general_course" name="general_course">
                    <option value="">Selecciona una opcion</option>
                    <option value='g'>General</option>
                    <option value='c'>Cursos</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="question_category_id" id="id_categoria">
                    <option value="">Selecciona una categoria</option>
                    @foreach ($question_category ?? [] as $item)

                    <option value="{{ $item->id }}">{{ $item->name }}</option>

                    @endforeach

                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="tipologia" class="form-label">Cursos</label>
                <select class="form-select" name="course" id="tipologia">
                    <option value="">Selecciona curso</option>
                    <option value='1'>Curso 1</option>
                    <option value='2'>Curso 2</option>
                    <option value='3'>Curso 3</option>
                    <option value='4'>Curso 4</option>
                    <option value='5'>Curso 5</option>
                    <option value='6'>Curso 6</option>
                    <option value='7'>Curso 7</option>
                    <option value='8'>Curso 8</option>
                    <option value='9'>Curso 9</option>
                    <option value='10'>Curso 10</option>
                    <option value='11'>Curso 11</option>
                    <option value='12'>Curso 12</option>
                    <option value='13'>Curso 13</option>
                    <option value='14'>Curso 14</option>
                    <option value='15'>Curso 15</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="tipologia" class="form-label">Tipologia</label>
                <select class="form-select" name="type" id="tipologia">
                    <option value="">Selecciona tipologia</option>
                    <option value='m'>Mecanica</option>
                    <option value='t'>Transito</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="direccionTienda" class="form-label">Pregunta</label>
                <input type="text" name="question" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion A</label>
                <input type="text" name="opt_a" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion B</label>
                <input type="text" name="opt_b" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion C</label>
                <input type="text" name="opt_c" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion D</label>
                <input type="text" name="opt_d" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion E</label>
                <input type="text" name="opt_e" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="respuesta" class="form-label">Respuesta</label>
                <select class="form-select" name="answer" id="respuesta">
                    <option value="">Selecciona una respuesta</option>
                    <option value='a'>Opcion A</option>
                    <option value='b'>Opcion B</option>
                    <option value='c'>Opcion C</option>
                    <option value='d'>Opcion D</option>
                    <option value='e'>Opcion E</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input class="form-control" type="file" name="image" accept="image/*">

            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input checked type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Activo</label>
                </div>
            </div>

            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>

<script>
    $('.iconpicker').iconpicker();
</script>
