<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Pais') }}</h4>

        <form action="{{ route('web.admin.project.survey_question.add.do') }}" class="form_ parent-load row"
            method="post">
            <input type="hidden" name="survey_id" value="{{ $survey->id }}">
            <div class="col-md-9 mb-3">
                <label for="name" class="form-label">{{ __('Questao') }}</label>
                <input type="text" name="question" id="name" class="form-control"
                    placeholder="{{ __('Digite o nome...') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">{{ __('Tipo de Questao') }}</label>
                <select name="question_type" class="form-control" id="qt">
                    <option value="open-answer">Pergunta Aberta</option>
                    <option value="boolean">Verdadeiro/Falso</option>
                    <option value="multiple">Escolha Multipla</option>
                    <option value="boolean-open-answer">Verdadeiro/Falso + Pergunta Aberta</option>
                    <option value="multiple-open-answer">Escolha Multipla + Pergunta Aberta</option>
                </select>
            </div>
            <div class="col-12 d-none" id="opc">

                <h4 class="row">
                    <div class="col-6">
                        {{ __('Adicionar Opcoes') }} </div>
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

<script>
    $("#qt").on("change", function() {
        switch ($(this).val()) {
            case "multiple":
                $("#opc").removeClass("d-none");
                break;
            case "multiple-open-answer":
                $("#opc").removeClass("d-none");
                break;

            default:
                $("#opc").addClass("d-none");
                $("#cities").html(" ");
                break;
        }


    });
</script>
<div class="d-none" id="jop_cities">
    <div class="im_dad row">
        <div class="col-12 text-end">
            <button class="btn btn-primary rm_dad" type="button"><i class="fa fa-trash"></i></button>

        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="form-label">{{ __('Opcao') }}</label>
                <input type="text" class="form-control" name="survey_question_option[]">
            </div>
        </div>
        <div class="col-12">
            <div class="dropdown-divider mt-3"></div>
        </div>

    </div>
</div>
