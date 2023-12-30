<!-- card start -->
<div class="card">
    <div class="card-header">
        <h4>Account Settings</h4>
    </div>
    <div class="card-body">

        <div class="row gutters">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                <form action="{{ route('web.admin.profile.update.do') }}" class="parent-load form_ prompt">
                    <div class="row gutters">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <img src="{{ tools()->photo($user->photo) }}"
                                class="img-fluid change-img-avatar nf_picture" alt="Image">
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                            <div class="col-12">
                                <button type="button" class="btn btn-info btn-sm btnpp"><i
                                        class="fa fa-image p-2"></i>Alterar Foto de Perfil</button>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <!-- Field wrapper start -->
                            <div class="form-group">
                                <div class="form-label">Nombres</div>
                                <input type="text" class="form-control" name="name" value="{{ $user->names }}">
                            </div>
                            <!-- Field wrapper end -->
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="last_name" class="form-label">{{ __('Apellido paterno') }}</label>
                            <input type="text" name="father_name" class="form-control" value="{{ $user->father_name }}">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="last_name" class="form-label">{{ __('Apellido materno') }}</label>
                            <input type="text" name="mother_name" class="form-control" value="{{ $user->mother_name }}">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <!-- Field wrapper start -->
                            <div class="form-group">
                                <div class="form-label">Telefono</div>
                                <input type="number" class="form-control" name="phone"
                                    value="{{ $user->phone }}">
                            </div>
                            <!-- Field wrapper end -->
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- Field wrapper start -->
                            <div class="form-group">
                                <div class="form-label">{{__('Correo')}}</div>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            <!-- Field wrapper end -->
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="balance" class="form-label">{{ __('Carnet de Identidad') }}</label>
                            <input type="text" name="national_id" class="form-control" value="{{ $user->national_id }}">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="email" class="form-label">{{ __('Edad') }}</label>
                            <input type="date" name="born_date" class="form-control" value="{{ $user->born_date }}">
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-2 col-sm-12 col-12 pt-3">
                            <button class="btn btn-secondary mb-3 chl_loader"><i
                                    class="fa fa-save p-2"></i>{{ __("Salvar") }}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="account-settings-block">

                    <div class="settings-block">
                        <div class="settings-block-title">Más definiciones</div>
                        <div class="settings-block-body">
                            <div class="list-group">

                                <div class="list-group-itdm">

                                    <button data-href="{{ route('web.admin.profile.password.update.index') }}"
                                        class="btn btn-secondary w-100 _link_"><i class="fa fa-key p-2"></i> Cambiar contraseña</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- card end -->


<!-- End Modal -->
<script type="text/javascript">
    $image_crop = $('#_pictureProfileIMG').croppie({
        enableExif: true,
        viewport: {
            width: 350,
            height: 350,
            type: 'square'
        },
        boundary: {
            width: 352,
            height: 352
        }
    });
    //$('#myModal').on('hidden.bs.modal', function() {})


    $('.picbtn').click(
        function() {
            $("#tgProfile_Pic").modal('hide');
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(
                function(response) {
                    var data = new FormData();
                    data.append('foto', response);
                    var url = "{{ route('web.admin.profile.change_picture') }}";
                    new request(url)
                        .setData(data)
                        .toNext()
                        .execute();
                });
        });

    $(".btnpp").click(
        function() {
            $("#_picture").click();
            $("#tgProfile_Pic").modal('show');
        });

    $('#_picture').on('change', function() {
        var that = this;
        setTimeout(function() {
            try {

                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {});
                }

                reader.readAsDataURL(that.files[0]);

            } catch (error) {

            }
        }, 500);
    });
</script>
