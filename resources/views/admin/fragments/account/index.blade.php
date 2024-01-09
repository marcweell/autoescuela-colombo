<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ tools()->photo($user->photo) }}" alt="avatar" class="rounded-circle img-fluid"
                            style="width: 150px;">
                        <h5 class="mt-3 mb-1">{{ $user->name . ' ' . $user->last_name }}</h5>
                        <p class="text-muted mb-3">{{ $user->code }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button type="button" role="button" class="btn btn-outline-primary ms-1 _link_"
                                data-href="{{ route('web.admin.profile.update.index') }}">Configuraciones de la
                                cuenta</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Edad</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->age }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nombres</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Apellido paterno</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->father_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Apellido materno</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->mother_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Celular</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ empty($user->phone) ? '' : "(".$user->idd.")" . $user->phone }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Correo</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Direccion</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->addrress }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Row start -->
        <div class="row pt-5">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- card start -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Historial de inicio de sesión</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive---">
                            <table class="table table_ table-centered w-100 dt-responsive">

                                <thead class="">
                                    <tr>
                                        <th>{{ __('IP') }}</th>
                                        <th>{{ __('Navegador') }}</th>
                                        <th>{{ __('Dispositivo') }}</th>
                                        <th>{{ __('Fecha/hora de registro') }}</th>
                                        <th>{{ __('Éxito') }}</th>
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
</section>
