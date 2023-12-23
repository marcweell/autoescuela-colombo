<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Pregunta') }}</h4>


        <form action="{{ route('web.admin.question.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $question->id }}">

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icona') }}</label>
                <input type="text" name="icon_file" class="form-control iconpicker" value="{{ $question->icon }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Color') }}</label>
                <input type="text" name="color" class="form-control hex_color" value="{{ $question->color }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="tipologia" class="form-label">General/Curso</label>
                <select class="form-select" name="general_course" id="general_couse">
                    <option value="">Selecciona una opcion</option>
                    <option {{ $question->general_course == 'g' ? 'selected' : '' }} value='g'>General
                    </option>
                    <option {{ $question->general_course == 'c' ? 'selected' : '' }} value='c'>Cursos
                    </option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="question_category_id" id="id_categoria">
                    <option value="">Selecciona una categoria</option>
                    @foreach ($question_category ?? [] as $item)
                        <option {{ $question->question_category_id == $item->id ? 'selected' : '' }}
                            value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="tipologia" class="form-label">Cursos</label>
                <select class="form-select" name="course" id="tipologia">
                    <option value="">Selecciona curso</option>
                    @for ($i = 1; $i < 16; $i++)
                        <option {{ $question->question_category_id == $i ? 'selected' : '' }}
                            value='{{ $i }}'>Curso {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="tipologia" class="form-label">Tipologia</label>
                <select class="form-select" name="type" id="tipologia">
                    <option value="">Selecciona tipologia</option>
                    <option {{ $question->type == 'm' ? 'selected' : '' }} value='m'>Mecanica</option>
                    <option {{ $question->type == 't' ? 'selected' : '' }} value='t'>Transito</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="direccionTienda" class="form-label">Pregunta</label>
                <input type="text" name="question" class="form-control" value="{{ $question->question }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion A</label>
                <input type="text" name="opt_a" class="form-control" value="{{ $question->opt_a }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion B</label>
                <input type="text" name="opt_b" class="form-control" value="{{ $question->opt_b }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion C</label>
                <input type="text" name="opt_c" class="form-control" value="{{ $question->opt_c }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion D</label>
                <input type="text" name="opt_d" class="form-control" value="{{ $question->opt_d }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pais" class="form-label">Opcion E</label>
                <input type="text" name="opt_e" class="form-control" value="{{ $question->opt_e }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="respuesta" class="form-label">Respuesta</label>
                <select class="form-select" name="answer" id="respuesta">
                    <option value="">Selecciona una respuesta</option>
                    <option {{ $question->answer == 'a' ? 'selected' : '' }} value='a'>Opcion A</option>
                    <option {{ $question->answer == 'b' ? 'selected' : '' }} value='b'>Opcion B</option>
                    <option {{ $question->answer == 'c' ? 'selected' : '' }} value='c'>Opcion C</option>
                    <option {{ $question->answer == 'd' ? 'selected' : '' }} value='d'>Opcion D</option>
                    <option {{ $question->answer == 'e' ? 'selected' : '' }} value='e'>Opcion E</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input class="form-control" type="file" name="image" accept="image/*">

            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input {{ $question->active == true ? 'checked' : '' }} type="checkbox" name="active" class="form-check-input" id="customCheck3">
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
