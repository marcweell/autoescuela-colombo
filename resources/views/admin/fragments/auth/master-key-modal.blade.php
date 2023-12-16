 <div class="card-body p-4">

     <form action="{{ route($route) }}" class="form_ parent-load">

         @foreach ($payloads ?? [] as $key => $value) 
             <input type="hidden" name="{{ $key }}" value="{{ $value }}">
         @endforeach

         <div class="mb-3">
             <label for="password" class="form-label">Digite a Master Key para Finalizar a operacao</label>
             <div class="input-group input-group-merge">
                 <input type="password" id="password" name="{{$keyName}}" class="form-control"
                     placeholder="Enter your password">
                 <div class="input-group-text" data-password="false">
                     <span class="fa fa-eye"></span>
                 </div>
             </div>
         </div>


         <div class="mb-3 mb-0 text-center">
             <button class="btn btn-secondary chl_loader" type="submit"> Autorizar </button>
         </div>

     </form>
 </div>
