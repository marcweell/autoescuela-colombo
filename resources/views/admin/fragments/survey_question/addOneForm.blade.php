<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Pais') }}</h4>

        <form action="{{ route('web.admin.survey.survey_question.add.do') }}" class="form_ parent-load row"
            method="post">
            <input type="hidden" name="survey_id" value="{{ $survey->id }}">
            <div class="col-md-9 mb-3">
                <label for="name" class="form-label">{{ __('Questao') }}</label>
                <input type="text" name="question" id="name" class="form-control"
                    placeholder="{{ __('Ingrese nombre...') }}">
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">{!! __('Opcoes de Respuesta') !!}</label>
                    <select name="question_type" class="form-control" id="qt">
                        <option value="">Selecione a opcoes</option>
                        <option value="open-ended-single">Texto Simples</option>
                        <option value="single-choice-radio">Escolha Unica</option>
                        <option value="multiple-choice">Escolha Multipla</option>
                        <option value="best-worst">Verdadeiro Falso</option>
                    </select>
                </div>
            </div>
            <div class="col-12" id="opc_">

            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>

<script>
    var btn = false;
    $("#qt").on('change', function() {
        var id = Date.now();
        $("#opc_").html("");
        switch ($(this).val()) {
            case "open-ended-single":
                var content = $("#open-ended-single").html();
                content = content.replace("contentId", "_" + id);
                content = content.replace("contentId", "_" + id);
                content = content.replace("contentId", "_" + id);

                $("#opc_").append(content);

                break;
            case "multiple-choice":
                var content = $("#choice-div").html();
                content = content.replace("contentId", "_" + id);
                content = content.replace("contentId", "_" + id);
                content = content.replace("contentId", "_" + id);

                $("#opc_").append(content);
                break;
            case "single-choice-radio":
                var content = $("#radio-div").html();
                content = content.replace("contentId", "_" + id);
                content = content.replace("contentId", "_" + id);
                content = content.replace("contentId", "_" + id);

                $("#opc_").append(content);
                break;
            case "best-worst":
                var content = $("#best-worst").html();
                $("#opc_").append(content);


                break;

            default:


                break;
        }

        app.listenner.listen("clickEvents");
    });
</script>


<div class="d-none" id="open-ended-single">
    <div class="im_dad row">
        <div class="col-9">
            <div class="form-group">
                <label class="form-label">{{ __('Tipo de Respuesta') }}</label>
                <input type="hidden" name="survey_question_option[contentId][]" value="open-ended-single">
                <input type="text" class="form-control" value="Texto Simples" disabled>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="form-label">{{ __('Numero de Linhas') }}</label>
                <input type="number" class="form-control" value="3"
                    name="survey_question_option[contentId][lines]">
            </div>
        </div>
        <div class="col-12">
            <div class="dropdown-divider mt-3"></div>
        </div>
    </div>
</div>


<div class="d-none" id="choice-div">

    <div class="im_dad row">

        <hr class="m-1">
        <h4 class="row pt-2">
            <div class="col-12 text-end">
                <button type="button" role="button" to="#contentId" elem-target="#choice-content"
                    class="clonehim btn btn-sm btn-secondary float-right chl_loader"><i
                        class="fa fa-plus"></i>{{ __('Agregar Opcoes') }}</button>
            </div>
        </h4>
        <hr class="m-1">
        <div id="contentId" class="row">

        </div>
        <div class="col-12">
            <div class="dropdown-divider mt-3"></div>
        </div>




    </div>

</div>

<div class="d-none" id="choice-content">
    <div class="col-md-6 im_dad ">
        <label class="form-label">{{ __('Tipo de Respuesta:') }}</label>
        <div class="input-group">
            <input type="text" class="form-control" name="survey_question_option[]" value="">
            <input type="checkbox" name="correct[]"><span class="mx-2">Correcto</span>
        </div>
    </div>
</div>



<div class="d-none" id="radio-div">

    <div class="im_dad row">

        <hr class="m-1">
        <h4 class="row pt-2">
            <div class="col-12 text-end">
                <button type="button" role="button" to="#contentId" elem-target="#radio-content"
                    class="clonehim btn btn-sm btn-secondary float-right chl_loader"><i
                        class="fa fa-plus"></i>{{ __('Agregar Opcoes') }}</button>
            </div>
        </h4>
        <hr class="m-1">
        <div id="contentId" class="row">

        </div>
        <div class="col-12">
            <div class="dropdown-divider mt-3"></div>
        </div>




    </div>

</div>

<div class="d-none" id="radio-content">
    <div class="col-md-6 im_dad ">
        <label class="form-label">{{ __('Tipo de Respuesta:') }}</label>
        <div class="input-group">
            <input type="text" class="form-control" name="survey_question_option[]" value="">
            <input type="radio" class="form-radio" name="correct[]"><span class="mx-2">Correcto</span>
        </div>
    </div>
</div>

















<div class="d-none" id="best-worst">
    <div class="row im_dad mb-3">
        <div class="col-md-12">
            <label class="form-label">{{ __('Tipo de Respuesta') }}</label>
            <div class="input-group">
                <input type="text" class="form-control" name="survey_question_option[]" value="Verdadeiro/Falso"
                    disabled>
                <select name="correct" class="form-control">
                    <option value="">Sem respuesta correcta definida</option>
                    <option value="1">Verdadeiro</option>
                    <option value="0">Falso</option>
                </select>
            </div>
        </div>
    </div>
</div>
