v<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Agregar Pregunta') }}</h4>

        <form action="{{ route('web.admin.question.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-4 mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="course_category_id" id="id_categoria">
                    <option value="">Selecciona una categoria</option>
                    @foreach ($course_category ?? [] as $item)

                    <option value="{{ $item->id }}">{{ $item->name }}</option>

                    @endforeach

                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="tipologia" class="form-label">Cursos</label>
                <select class="form-select" name="course_id" id="tipologia">
                    <option value="">Selecciona curso</option>
                    @foreach ($course ?? [] as $item)

                    <option value="{{ $item->id }}">{{ $item->name }}</option>

                    @endforeach
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
                        class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>

<script>
    $('.iconpicker').iconpicker();
</script>
