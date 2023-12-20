<form method="post" action="{{ route('web.admin.account.activation.auth') }}" method="post" class="form_ parent-load">
    <div class="">
        <div class="login-body">
            <input type="hidden" name="token" value="{{ $token }}"> 
            <input type="hidden" name="email" value="{{ $email }}">
         
            <h6 class="p-2">Insira suas credenciais para iniciar sessao.</h6>
             
            <div class="field-wrapper">
                <input name="password" type="password" autofocus>
                <div class="field-placeholder">Senha</div>
            </div> 
            <div class="field-wrapper">
                <input name="confirm_password" type="password" autofocus>
                <div class="field-placeholder">Confirme a Senha</div>
            </div> 
            <div class="actions"> 
                <button type="submit" class="btn btn-secondary chl_loader">Fonfirmar</button>
            </div>
        </div> 
    </div>
</form>