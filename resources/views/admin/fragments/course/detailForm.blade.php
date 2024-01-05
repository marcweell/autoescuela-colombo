

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Profile -->
                                <div class="card bg-dark">
                                    <div class="card-body profile-user-box">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avatar-lg">
                                                            <img src="{{ Flores\Tools::photo($course->logo,"storage/files/") }}" alt="" class="img-thumbnail">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div>
                                                            <h4 class="mt-1 mb-1 text-white">{{ $course->name }}</h4>
                                                            <p class="font-13 text-white-50">{{ $course->course_category_name }}</p>
     
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col-->

                                            <div class="col-sm-4">
                                                <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                                    <button type="button" class="btn btn-light _link_" data-href="{{ route('web.admin.course.update.index') }}" data-id="{{ $course->id }}">
                                                        <i class="fa fa-edit me-1"></i> Editar Dados
                                                    </button>
                                                </div>
                                            </div> <!-- end col-->
                                        </div> <!-- end row -->

                                    </div> <!-- end card-body/ profile-user-box-->
                                </div><!--end profile/ card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-xl-4">
                                <!-- Personal-Information -->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-3">{{__("Informacoes")}}</h4>
                                        <p class="text-muted font-13">
                                        {{ $course->description }} 
                                        </p>

                                        <hr/>

                                        <div class="text-start">
                                            <p class="text-muted"><strong>{{ __("Criador") }} :</strong> <span class="ms-2">{{ $course->creator_name.' '.$course->creator_last_name}}</span></p>

                                            @foreach ($course->contact as $item)
                                            <p class="text-muted"><strong>{{ __($item->contact_type_name) }} :</strong><span class="ms-2">{{ $item->contato }}</span></p>
                                                
                                            @endforeach

                                            <p class="text-muted"><strong>Languages :</strong>
                                                <span class="ms-2"> English, German, Spanish </span>
                                            </p>
                                            <p class="text-muted mb-0" id="tooltip-container"><strong>Elsewhere :</strong>
                                                <a class="d-inline-block ms-2 text-muted" data-bs-container="#tooltip-container" data-bs-placement="top" data-bs-toggle="tooltip" href="" title="Facebook"><i class="mdi mdi-facebook"></i></a>
                                                <a class="d-inline-block ms-2 text-muted" data-bs-container="#tooltip-container" data-bs-placement="top" data-bs-toggle="tooltip" href="" title="Twitter"><i class="mdi mdi-twitter"></i></a>
                                                <a class="d-inline-block ms-2 text-muted" data-bs-container="#tooltip-container" data-bs-placement="top" data-bs-toggle="tooltip" href="" title="Skype"><i class="mdi mdi-skype"></i></a>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <!-- Personal-Information -->

                                <!-- Toll free number box-->
                                <div class="card text-white bg-info overflow-hidden">
                                    <div class="card-body">
                                        <div class="toll-free-box text-center">
                                            <h4> <i class="mdi mdi-deskphone"></i> Toll Free : 1-234-567-8901</h4>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                                <!-- End Toll free number box-->
 

                            </div> <!-- end col-->

                            <div class="col-xl-8">

 

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
                                                <i class="dripicons-basket float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Orders</h6>
                                                <h2 class="m-b-20">1,587</h2>
                                                <span class="badge bg-primary"> +11% </span> <span class="text-muted">From previous period</span>
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

                                    <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
                                                <i class="dripicons-box float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Revenue</h6>
                                                <h2 class="m-b-20">$<span>46,782</span></h2>
                                                <span class="badge bg-danger"> -29% </span> <span class="text-muted">From previous period</span>
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

                                    <div class="col-sm-4">
                                        <div class="card tilebox-one">
                                            <div class="card-body">
                                                <i class="dripicons-jewel float-end text-muted"></i>
                                                <h6 class="text-muted text-uppercase mt-0">Product Sold</h6>
                                                <h2 class="m-b-20">1,890</h2>
                                                <span class="badge bg-primary"> +89% </span> <span class="text-muted">Last year</span>
                                            </div> <!-- end card-body-->
                                        </div> <!--end card-->
                                    </div><!-- end col -->

                                </div>
                                <!-- end row -->


                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Membros</h4>

                                        <div class="table-responsive--">
                                            <table class="table table_ table-sm table-smtable-hover table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nome Completo</th>
                                                        <th>Usuario</th>
                                                        <th>Stock</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ([1,1,1,1,11,1,11,1,1,11,11,1,1,11,11,1,1,1] as $item)
                                                        
                                                    <tr>
                                                        <td>ASOS Ridley High Waist</td>
                                                        <td>$79.49</td>
                                                        <td><span class="badge bg-primary">82 Pcs</span></td>
                                                    </tr> 
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- end table responsive-->
                                    </div> <!-- end col-->
                                </div> <!-- end row-->

                            </div>
                            <!-- end col -->

                        </div>
                        <!-- end row -->