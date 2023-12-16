<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Metodo de pagamento de Usuario') }}</h4>

        <form action="{{ route('web.app.user_payment_method.add.do') }}" class="form_ parent-load-- row" method="post">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Metodo de pagamento') }}</label>
                <select name="payment_method_id" id="payment_method_id" class="form-control">
                    <option value="">Selecione o metodo de pagamento</option>
                    @foreach ($payment_method as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Moeda') }}</label>
                <select name="currency_id" id="user_id" class="form-control">
                    @foreach ($currency as $item)
                        <option {{ $item->code == 'BRL' ? 'selected' : '' }} value="{{ $item->id }}">
                            {{ $item->code . ' - ' . $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3 d-none" id="antype">
                <label for="name" class="form-label">{{ __('Tipo de Codigo') }}</label>
                <select name="account_number_type" id="account_number_type" class="form-control">
                </select>
            </div>

            <div class="col-md-12 mb-3" id="pid_type">
                <label for="name" class="form-label">{{ __('Codigo da Conta') }}</label>
                <input type="text" name="account_number" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome de usuario ou numero da conta...') }}">
            </div>



            <div class="col-md-12 mb-3 d-none" id="compny">
                <label for="name" class="form-label">{{ __('Rede') }}</label>
                <select name="company" id="company_s" class="form-control">
                </select>
            </div>


            <div class="col-md-12">
                <button type="submit" class="btn btn-dark  chl_loader--"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>


<script>
    $(function() {
        $("#payment_method_id").on('change', function() {

            $("#account_number_type").empty();
            $("#company_s").empty();
            $("#antype").addClass("d-none");
            $("#compny").addClass("d-none");

            switch ($("#payment_method_id option:selected").text().toLowerCase().replace("\n","").trim()) {
                case 'pix':
                    $("#antype").removeClass("d-none");

                    $("#account_number_type").append(
                        $('<option>', {
                            value: "pix",
                            text: "pix"
                        })
                    );

                    $("#account_number_type").append(
                        $('<option>', {
                            value: "email",
                            text: "email"
                        })
                    );

                    $("#account_number_type").append(
                        $('<option>', {
                            value: "cpf",
                            text: "cpf"
                        })
                    );

                    $("#account_number_type").append(
                        $('<option>', {
                            value: "telefone",
                            text: "telefone"
                        })
                    );

                    $("#account_number_type").append(
                        $('<option>', {
                            value: "chave aleatoria",
                            text: "chave aleatoria"
                        })
                    );

                    $("#pid_type").removeClass("col-md-12");
                    $("#pid_type").addClass("col-md-6");

                    break;
                case 'usdt':
                    $("#compny").removeClass("d-none");

                    $("#company_s").append(
                        $('<option>', {
                            value: "Binace",
                            text: "Binace"
                        })
                    );   

                    $("#company_s").append(
                        $('<option>', {
                            value: "Ethereum",
                            text: "Ethereum"
                        })
                    );   

                    $("#company_s").append(
                        $('<option>', {
                            value: "TRX",
                            text: "TRX"
                        })
                    );     

                    break;
                    default:


                    $("#pid_type").addClass("col-md-12");
                    $("#pid_type").removeClass("col-md-6");
            }









        });
    });
</script>
