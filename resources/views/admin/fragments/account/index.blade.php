
                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            <div class="profile-header">
                                <h1><label></label></h1>
                                <div class="profile-header-content">
                                    <div class="profile-header-tiles">
                                        <div class="row gutters">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="profile-tile">
                                                    <span class="icon">
                                                        <i class="icon-server"></i>
                                                    </span>
                                                    <h6><span>{{ implode(" ",[$user->name,$user->last_name]) }}</span></h6>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="profile-tile">
                                                    <span class="icon">
                                                        <i class="icon-map-pin"></i>
                                                    </span>
                                                    <h6><span>{{  $user->city_name }}</span></h6>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="profile-tile">
                                                    <span class="icon">
                                                        <i class="icon-phone1"></i>
                                                    </span>
                                                    <h6><span>{{ $user->phone }}</span></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-avatar-tile">
                                        <img src="{{ tools()->photo($user->profile_picture) }}" class="img-fluid" alt="User Profile" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row end -->

                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                            <!-- Row start -->
                            <div class="row gutters">
                          
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <!-- card start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Historico de Login</div>
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
                                                        @for ($i = 0, $n = 1; $i < count($session_history ?? []) or $i<10, ($item = @$session_history[$i]); $i++, $n++)
                                                            <tr> 
                                                                <td> {{ $item->ip }}</td>
                                                                <td> {{ $item->browser }}</td>
                                                                <td> {{ $item->device }}</td> 
                                                                <td> {{ tools()->date_convert($item->created_at) }} </td>
                                                                <td> {!! ($item->success)?"<i class='fa fa-check text-success'></i>":"<i class='fa fa-times text-danger'></i>" !!}</td>
                                                               
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
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <!-- card start -->
                                    <div class="stats-tile4 min-height">
                                        <div class="stats-icon4">
                                            <i class="icon-receipt"></i>
                                        </div>
                                        <h3>{{ count($session_history??[]) }}</h3>
                                        <h4>Sessoes no sistema</h4>
                                    </div>
                                    <!-- card end -->
                                </div>  
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <!-- card start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Mais Dados Pessoais</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="customScroll250">
                                                <ul class="recent-orders">
                                                    <li> 
                                                        <div class="order-details">
                                                            <h5 class="order-title">Data de Nascimento</h5>
                                                            <p class="order-desc">{{ tools()->date_convert($user->born_date,'d-m-Y') }}</p> 
                                                        </div>
                                                    </li> 
                                                    <li> 
                                                        <div class="order-details">
                                                            <h5 class="order-title">Email</h5>
                                                            <p class="order-desc">{{ $user->email }}</p> 
                                                        </div>
                                                    </li> 
                                                    <li> 
                                                        <div class="order-details">
                                                            <h5 class="order-title">Endereco</h5>
                                                            <p class="order-desc">{{ $user->address }}</p> 
                                                        </div>
                                                    </li> 
                                                    <li> 
                                                        <div class="order-details">
                                                            <h5 class="order-title">Biografia</h5>
                                                            <p class="order-desc">{{ $user->bio }}</p> 
                                                        </div>
                                                    </li>  
                                                    <li class="m-0"> 
                                                        <button data-href="{{ route("web.admin.profile.update.index") }}" class="btn btn-dark w-100 l14k"><i class="fa fa-arrow-right p-2"></i> Definicoes de Conta</button>
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