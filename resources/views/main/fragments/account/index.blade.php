

                    <!-- Row start -->
                    <div class="row gutters">

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <!-- Row start -->
                            <div class="row gutters">

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
                                                        <button data-href="{{ route("web.admin.profile.update.index") }}" class="btn btn-primary w-100 _link_"><i class="fa fa-arrow-right p-2"></i> Definicoes de Conta</button>
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
