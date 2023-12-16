<style>
    .min-h {}

    .c_hiden {
        visibility: hidden;
        opacity: 0;
    }

    .minim {
        max-height: 65px;
    }

    .club-info {
        padding: 0px;
    }

    .club-info label {
        left: 0px;
        white-space:;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 2px;
        font-size: 11pt;
        margin: 0 5%;
        font-weight: bold;
        width: 90%;
        background: #fff;
        box-shadow: 1px 1px 1px;
        position: relative;
        top: -15px;
    }

    .club-info img {
        border-radius: 100%;
        background: #eee;
        max-width: 100px !important;
        padding: 10px;
        border: 4px solid #949494;
        display: block;
        margin: 10px auto;
    }

    @media (min-width: 768px) {}

    @media (max-width: 992px) {
        .offset-4-5 {
            margin-left: 38.666667%;
        }
    }


    @media (min-width: 992px) {
        .mentor_ {
            margin-top: 80px;
        }
    }

    @media (max-width: 768px) {

        .mtr {
            display: none;
        }

    }

    .mentor_ img {}

    .bhr {
        border-bottom: 2px solid;
        margin-bottom: 10px;
        padding-bottom: 10px;
    }

    .b_info {
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        padding: 0px;
        font-size: 14pt;

    }
</style>


@php
    
    function user_data($id, $type, $part_id, $paids = [])
    {
        $user = (new App\Services\user\UserServiceQueryImpl())->findById($id);
    
        if (empty($user->id)) {
            return '';
        }
    
        $social = (new App\Services\user_social_media\User_social_mediaServiceQueryImpl())->byUserId($id)->findAll();
    
        $html = '';
        $html .= "<div class='text-start text-left'>";
        $html .= 'Nome: ' . implode(' ', [$user->name, $user->last_name]);
        $html .= '<br/>';
        $html .= 'Email: ' . $user->email;
        $html .= '<br/>';
        $html .= 'Cidade: ' . $user->country_name;
        $html .= '<br/>';
        if ($type == 'doador') {
            $html .= 'Ativo: ' . (in_array($part_id, $paids) ? 'SIM' : 'NAO');
            $html .= '<br/>';
        }
        if (!empty($user->indicator_id)) {
            $html .= 'Convidado/a Por: ' . $user->indicator_full_name;
            $html .= '<br/>';
        }
        $html .= '<ul>';
        $html .= "<h6 class='d-block text-white'>";
        $html .= 'Redes Sociais:';
        $html .= '</h6>';
        foreach ($social as $key => $item) {
            $html .= "<li class='text-white'>";
            $html .= ' * ' . $item->social_media_name . ': ' . $item->profile_id;
            $html .= '</li>';
            $html .= '<br/>';
        }
        $html .= '</ul>';
        $html .= '</div>';
    
        return $html;
    }
    
@endphp


<div class="card">
    <div class="card-header">

        <h4 class="header-title"
            style="{{ empty($mandala->hex_color) ? '' : 'color: ' . $mandala->hex_color . '!important;' }}">
            <img style="width: 40px;margin: 10px;" src="{{ tools()->photo($mandala->plan_icon) }}" alt=""><span
                style="font-size: 16pt;">{{ $mandala->name }}
                <small class="d-block" style="color: #bfbcbc;font-size: 12pt;">ID: {{ $mandala->code }}</small>
            </span>

        </h4>

        <button data-id="{{ $mandala->id }}" class="btn btn-lg btn-dark m-3 l14k"
            data-href="{{ route('web.admin.mandala.participant.manage.index') }}"><i class="fa fa-cog"></i>
            Gerenciar</button>
    </div>
    <div class="card-body">

        <div class="row d-none d-lg-flex bhr">


            <div class="col-12 col-lg b_info">
                DOADORES
            </div>
            <div class="col-12 col-lg  b_info">
                CONSTRUTOR
            </div>
            <div class="col-12 col-lg  b_info">
                RECEBEDOR
            </div>
            <div class="col-12 col-lg b_info ">
                CONSTRUTOR
            </div>
            <div class="col-12 col-lg b_info">
                DOADORES
            </div>


        </div>

        <div class="row">

            <div class="col-12 col-lg">
                <div class="row">
                    @foreach ($tree1 as $pattern)
                        @foreach ($pattern->children as $item)
                            <button class="btn offset-2 offset-lg-0 col-3 club-info col-lg-12 min-h  xtool"
                                title="{{ user_data($item->user_id, $item->type, $item->id, $paids) }}">
                                <img src="{{ tools()->photo($item->user_profile_picture) }}" class="w-100">
                                <label
                                    class="{{ $item->id == null ? 'force-white' : 'text-dark' }} text-center">{{ $item->user_code }}</label>
                            </button>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <div class="col-12 col-lg ">
                <div class="row ">
                    @foreach ($tree1 as $item)
                        <button class="btn col-3 club-info mentor_ col-lg-12 min-h offset-4-5 offset-lg-0  xtool"
                            title="{{ user_data($item->user_id, $item->type, $item->id, $paids) }}">
                            <img src="{{ tools()->photo($item->user_profile_picture) }}" class="w-100">
                            <label
                                class="{{ $item->id == null ? 'force-white' : 'text-dark' }} text-center">{{ $item->user_code }}</label>
                        </button>
                    @endforeach

                </div>
            </div>

            <div class="col-12 col-lg">
                <div class="row ">
                    <button class="btn col-3 club-info mentor_ col-lg-12 min-h offset-4-5 offset-lg-0 xtool"
                        title="{{ user_data($beneficiary->user_id, 'receptor', $beneficiary->id, $paids) }}">
                        <img src="{{ tools()->photo($beneficiary->user_profile_picture) }}" class="w-100">
                        <label class="text-dark text-center">{{ $beneficiary->user_code }}</label>
                    </button>
                </div>

            </div>

            <div class="col-12 col-lg ">
                <div class="row ">
                    @foreach ($tree2 as $item)
                        <button class="btn col-3 club-info mentor_ col-lg-12 min-h offset-4-5 offset-lg-0  xtool"
                            title="{{ user_data($item->user_id, $item->type, $item->id, $paids) }}">
                            <img src="{{ tools()->photo($item->user_profile_picture) }}" class="w-100">
                            <label
                                class="{{ $item->id == null ? 'force-white' : 'text-dark' }} text-center">{{ $item->user_code }}</label>
                        </button>
                    @endforeach

                </div>
            </div>

            <div class="col-12 col-lg">
                <div class="row">
                    @foreach ($tree2 as $pattern)
                        @foreach ($pattern->children as $item)
                            <button class="btn offset-2 offset-lg-0  col-3 club-info col-lg-12 min-h xtool"
                                title="{{ user_data($item->user_id, $item->type, $item->id, $paids) }}">
                                <img src="{{ tools()->photo($item->user_profile_picture) }}" class="w-100">
                                <label
                                    class="{{ $item->id == null ? 'force-white' : 'text-dark' }} text-center">{{ $item->user_code }}</label>
                            </button>
                        @endforeach
                    @endforeach
                </div>
            </div>

        </div>






    </div>
</div>


<script>
    $(function() {

        $(".xtool").each(function(e) {

            var elem = this;
            var id = elem.getAttribute("data-code");
            var str = $(id).html();

            $(elem).tooltip({
                html: true,
            });

        });
    });
</script>
