 
 <!-- Row start -->

 <div class="row gutters">
     <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
         <!-- Row start -->
         <div class="row gutters">

             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                 <!-- card start -->
                 <div class="card">
                     <div class="card-header">
                         <div class="card-title ">{{ __("Historico de Login") }}</div>
                     </div>
                     <div class="card-body">
                         <div class="table-responsive">
                             <table class="table table_ table-centered w-100 dt-responsive">

                                 <thead class="">
                                     <tr>
                                         <th>{{ __('IP') }}</th>
                                         <th>{{ __('Navegador') }}</th>
                                         <th>{{ __('Dispositivo') }}</th>
                                         <th>{{ __('Data/Hora de Registo') }}</th>
                                         <th>{{ __('Sucesso') }}</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @for ($i = 0, $n = 1; $i < count($session_history ?? []) or $i < 10, ($item = @$session_history[$i]); $i++, $n++)
                                         <tr>
                                             <td> {{ $item->ip }}</td>
                                             <td> {{ $item->browser }}</td>
                                             <td> {{ $item->device }}</td>
                                             <td> {{ tools()->date_convert($item->created_at) }} </td>
                                             <td> {!! $item->success ? "<i class='fa fa-check text-success'></i>" : "<i class='fa fa-times text-danger'></i>" !!}</td>

                                         </tr>
                                     @endfor
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
                 <!-- card end -->
             </div>
         </div>
         <!-- Row end -->
     </div>
     <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
         <!-- Row start -->
         <div class="row gutters">
             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                 <!-- card start -->
                 <div class="card">
                     <div class="card-header">
                         <div class="card-title ">{{ __("Mais Dados Pessoais") }}</div>
                     </div>
                     <div class="card-body">
                         <div class="customScroll250">
                             <ul class="recent-orders">
                                 <li>
                                     <div class="order-details">
                                         <h5 class="order-title">{{ __("Data de Nascimento") }}</h5>
                                         <p class="order-desc">{{ tools()->date_convert($user->born_date, 'd-m-Y') }}</p>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="order-details">
                                         <h5 class="order-title">{{ __("Email") }}</h5>
                                         <p class="order-desc">{{ $user->email }}</p>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="order-details">
                                         <h5 class="order-title">{{ __("Endereco") }}</h5>
                                         <p class="order-desc">{{ $user->address }}</p>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="order-details">
                                         <h5 class="order-title">{{ __("Biografia") }}</h5>
                                         <p class="order-desc">{{ $user->bio }}</p>
                                     </div>
                                 </li>
                                 <li class="m-0">
                                     <button data-href="{{ route('web.app.profile.update.index') }}"
                                         class="btn btn-dark w-100 l14k"><i class="fa fa-arrow-right p-2"></i>
                                         {{ __("Definicoes de Conta") }}</button>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <!-- card end -->
             </div>
         </div>
         <!-- Row end -->
     </div>
 </div>

 <!-- Row end -->

 <script>
     $(function() {
         _ChartJs.hBar("#user", {!! getSummary($session_history) !!}, "{!! __('Ultimos users Cadastrados') !!}");
         _ChartJs.hBar("#user1", {!! getSummary($session_history) !!}, "{!! __('Ultimos users Cadastrados') !!}");
     });
 </script>
