 <div class="card-body p-4">

     <div class="text-center w-75 m-auto">
         <h4 class="-50 text-center pb-0 fw-bold">Entrar</h4>
         <p class="text-muted mb-4">Digite o seu Email ou Numero de Telefono para continuar.</p>
     </div>

     <form action="{{ route('web.admin.account.auth.reAuth') }}" class="form_ parent-load">
         <input type="hidden" name="handshake" value="{{ $handshake }}">
         <div class="mb-3">
             <label for="user" class="form-label">Email/Nombre de Usuario</label>
             <input class="form-control" name="user" type="text" id="user" required=""
                 placeholder="Enter your email">
         </div>

         <div class="mb-3">
             <a href="pages-recoverpw.html" class="text-muted float-end"><small>Esqueceu sua senha?</small></a>
             <label for="password" class="form-label">Senha</label>
             <div class="input-group input-group-merge">
                 <input type="password" id="password" name="password" class="form-control"
                     placeholder="">
                 <div class="input-group-text" data-password="false">
                     <span class="fa fa-eye"></span>
                 </div>
             </div>
         </div>

         <div class="mb-3 mb-3">
             <div class="form-check">
                 <input type="checkbox" class="form-check-input" id="checkbox-signin" checked="">
                 <label class="form-check-label" for="checkbox-signin">Lembrar Sessao</label>
             </div>
         </div>

         <div class="mb-3 mb-0 text-center">
             <button class="btn btn-secondary chl_loader" type="submit"> Autenticar </button>
         </div>

     </form>
 </div>
