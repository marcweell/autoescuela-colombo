<form method="post" action="{{ route('web.account.activation.auth') }}" method="post" class="form_ parent-load">
    <div class="">
        <div class="row">
            <input type="hidden" name="token" value="{{ $token }}"> 
            <input type="hidden" name="email" value="{{ $email }}">
         
            <h6 class="p-2">{{ __("Insira suas credenciais para iniciar sessao") }}</h6>
             
            <div class="col-12 mb-3">
                <label for="">{{ __("Digite uma nova senha") }}</label>
                <div class="input-group">
                    <input type="password" id="pwd" class="form-control" name="password">
                    <div class="input-group-append">
                        <button id="togglePassword" class="btn btn-dark btn-lg rounded-0" type="button"><i
                                class="fa fa-eye"></i></button>
                    </div>
                </div>

            </div> 
            <div class="col-12 mb-3">
                <label for="">{{ __("Confirme sua senha") }}</label>
                <input class="form-control" name="confirm_password" type="password" autofocus>
            </div> 

            <div class="col-md-12 mb-3"> 
                <button type="submit" class="btn btn-dark chl_loader">{{ __("Confirmar") }}</button>
            </div>
        </div> 
    </div>
</form>