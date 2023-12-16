<div class="setting mt-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row mb-3">

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <img src="{{ tools()->photo($user->profile_picture) }}"
                                class="img-fluid change-img-avatar nf_picture" alt="Image">
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                            <div class="col-12">

                                <button type="button" class="btn mt-3  btn-dark btn-sm btnpp"><i
                                        class="fa fa-image p-2"></i>{{ __('Alterar Foto de Perfil') }}</button>
                            </div>
                        </div>
                    </div>
                    <h3>{{ __("Meu Perfil") }}</h3>
                    @if (!empty($user->indicator_id))
                        <div class="alert alert-dark mt-2 mb-2">
                            <h6 class="text-dark">
                                {{ __('Indicador') }}: {{ $user->indicator_name.' '.$user->indicator_last_name }}
                            </h6>
                        </div>
                    @endif
                    <div class="form">
                        <form action="{{ route('web.app.profile.update.do') }}" class="parent-load-- form_ ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Nome') }}</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Sobrenome') }}</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $user->last_name }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Email') }}</label>
                                        <input disabled type="email" class="form-control" name="email"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Telefone') }}</label>
                                        <div class="input-group">
                                            <select class="form-control w-25" style="width: 25%" name="idd_country_id">
                                                @foreach ($country as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ strtolower($item->code) == 'br' ? 'selected' : '' }}>
                                                        {{ $item->idd . '     (' . $item->name . ' - ' . $item->native_name . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="text" class="form-control w-75" placeholder=""
                                                aria-label="" aria-describedby="basic-addon1" name="phone"
                                                value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __("Pais") }}</label>
                                        <select name="country_id" class="form-control">
                                            @foreach ($country as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $user->country_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __("Endereco") }}</label>
                                        <textarea name="address" class="form-control" rows="2">{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __("Biografia") }}</label>
                                        <textarea name="bio" class="form-control" rows="5">{{ $user->bio }}</textarea>
                                    </div>
                                </div>
                                <!--div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __("Fuso Horario") }}</label>
                                        <select name="timezone" class="form-control">
                                            @foreach ($timezones as $item)
                                                <option value="{{ $item->offset.'.'.$item->abbr }}"
                                                    {{ $user->timezone == $item->offset.'.'.$item->abbr ? 'selected' : '' }}>
                                                    {{ $item->text  }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __("Usuario") }}</label>
                                        <input type="text" class="form-control" name="code"
                                            value="{{ $user->code }}">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" checked type="checkbox" name="change_user"
                                            id="remember">
                                        <label class="form-check-label" for="remember">
                                           {{ __("Alterar Nome de Usuario") }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn mt-3  btn-dark chl_loader--">{{ __('Confirmar') }}</button>
                                 </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>{{ __("Alterar Senha") }}</h3>
                    <div class="form">
                        <form action="{{ route('web.app.profile.password.update.do') }}"
                            class="form_ parent-load-- row " method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __("Senha Atual")  }}</label>
                                        <input name="old_password" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __("Nova Senha") }}</label>
                                        <input name="password" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __("Confirme a Senha") }}</label>
                                        <input name="confirm_password" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn mt-3  btn-dark chl_loader--">{{ __('Confirmar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h3>{{ __("Redes Sociais") }}</h3>
                    <div class="form">
                        <div class="row">
                            <div class="col-12">



                                <table class="table">
                                    @foreach ($user_social_media as $item)
                                        <tr>
                                            <td style="width: 80%;border:none;">
                                                {{ $item->social_media_name . ' - ' . $item->profile_id }}</td>
                                            <td style="width: 20%;border:none;" class="d-flex">
                                                <button
                                                    data-href="{{ route('web.app.user_social_media.update.index') }}"
                                                    data-id='{{ $item->id }}'
                                                    class="l14k m-2 d-inline btn mt-3  btn-sm btn-secondary rounded-80"><i
                                                        class="fa fa-edit"></i></button>
                                                <button data-href="{{ route('web.app.user_social_media.remove.do') }}"
                                                    data-id='{{ $item->id }}'
                                                    class="l14k m-2 d-inline btn mt-3  btn-sm btn-secondary rounded-80 prompt"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>


                            </div>

                            <div class="col-md-12">
                                <button type="button" role="button" class="btn mt-3  btn-dark l14k"
                                    data-href="{{ route('web.app.user_social_media.add.index') }}">{{ __("Adicionar Rede Social") }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <h3>{{ __("Metodos de Pagamento") }}</h3>
                        <div class="form">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table">
                                        @foreach ($user_payment_method as $item)
                                            <tr>
                                                <td style="width: 80%;border:none;">
                                                    {{ $item->payment_method_name . ' - ' . $item->account_number }} {{ (!empty($item->account_number_type) and strtolower($item->payment_method_name) == 'pix') ? " ({$item->account_number_type})" : '' }}  {{ (!empty($item->company) and strtolower($item->payment_method_name) == 'usdt') ? " [{$item->company}]" : '' }}
                                                </td>
                                                <td style="width: 20%;border:none;" class="d-flex">
                                                    <button
                                                        data-href="{{ route('web.app.user_payment_method.update.index') }}"
                                                        data-id='{{ $item->id }}'
                                                        class="l14k m-2 d-inline btn mt-3  btn-sm btn-secondary rounded-80"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button
                                                        data-href="{{ route('web.app.user_payment_method.remove.do') }}"
                                                        data-id='{{ $item->id }}'
                                                        class="l14k m-2 d-inline btn mt-3  btn-sm btn-secondary rounded-80 prompt"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <button type="button" role="button" class="btn mt-3  btn-dark l14k"
                                        data-href="{{ route('web.app.user_payment_method.add.index') }}">{{ __('Adicionar Metodo de Pagamento') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
                        var url = "{{ route('web.app.profile.change_picture') }}";
                        new request(url)
                            .setData(data)
                            .toNext()
                            .execute();
                    });
            });

        $(".btnpp").click(
            function() {
                $("#tgProfile_Pic").modal('show');
                $("#_picture").click();
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
