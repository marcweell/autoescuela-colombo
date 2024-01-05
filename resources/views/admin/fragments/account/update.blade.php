<!-- card start -->
<div class="card">
    <div class="card-header-lg">
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

                                <button type="button" class="btn btn-primary btn-sm btnpp"><i
                                        class="fa fa-image p-2"></i>Alterar Foto de
                                    Perfil</button>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                <div class="field-placeholder">Nombre</div>
                            </div>
                            <!-- Field wrapper end -->
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ $user->last_name }}">
                                <div class="field-placeholder">Apelido</div>
                            </div>
                            <!-- Field wrapper end -->
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                <div class="field-placeholder">Email</div>
                            </div>
                            <!-- Field wrapper end -->
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="phone" class="form-label">{{ __('Telefone') }}</label>
                                <div class="input-group">
                                    <select class="form-control w-25" style="width: 25%" name="idd_country_id">
                                        @foreach ($country as $item)
                                            <option value="{{ $item->id }}" {{ (strtolower($item->code)=="br")?"selected":"" }}>{{ $item->idd . "     (".$item->name." - ".$item->native_name.")" }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control w-75" placeholder="" aria-label=""
                                        aria-describedby="basic-addon1" name="phone" value="{{ $user->phone }}">
                                </div>
                            </div>
                        <div class="col-xl-12 col-lg-12 col-md-2 col-sm-12 col-12">
                            <button class="btn btn-secondary mb-3 chl_loader"><i
                                    class="fa fa-save p-2"></i>{{ __("Salvar") }}</button>
                            <button data-href="{{ route('web.admin.profile.index') }}" class="btn btn-primary mb-3 _link_"><i
                                    class="fa fa-arrow-left p-2"></i> Voltar ao Perfil</button>

                        </div>
                    </div>
                </form>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="account-settings-block">

                    <div class="settings-block">
                        <div class="settings-block-title">Mais Definicoes</div>
                        <div class="settings-block-body">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>Receber Notificacoes por Email</div>
                                    <div class="form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label"></label>
                                    </div>
                                </div>
                                <div class="list-group-itdm">

                                    <button data-href="{{ route('web.admin.profile.password.update.index') }}"
                                        class="btn btn-secondary w-100 _link_"><i class="fa fa-key p-2"></i> Alterar
                                        Senha</button>
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
