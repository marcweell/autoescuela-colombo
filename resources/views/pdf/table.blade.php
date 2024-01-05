<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $titulo ?? 'Documento' }}</title>
    <style>
        .pagenum:before {
            content: counter(page);
        }

        html {
            margin: 0px;
            padding: 50px 0px 0px 0px;
        }

        body {
            padding: 5cm 2cm 2cm 2cm;
            font-family: 'Courier New', Courier, monospace !important;
        }

        .background {

            position: fixed;
            top: 30%;
            text-align: center;
            opacity: 0.25;
        }

        .background img {
            width: 700px;
        }

        td,
        th {
            word-break: break-all !important;
            padding: 3px !important;
            font-size: 9.5pt !important;
        }

        th {
            text-transform: uppercase;
        }

        table {
            float: left;
            width: 100%;
        }

        header {
            /*position: fixed;
            top: 40px;*/
        }

        .text-center {
            text-align: center !important;
        }

    </style>
</head>

<body>
    <header>

        <div class="text-center" style="margin:0px 0px 20px 0px">
            <img width="60px" style='margin-bottom:6px;diplay:block;'
                src="{{ tools()->filetobase64('public/assets/img/logo.png') }}" alt="">
            <h4 style='margin:2px;'>
                BNBC
            </h4>
            <h5 style='margin:2px auto;;'>
                <span style="padding-bottom: 10px;">RECRUTAMENTGO E SELEÇÃO</span>
                <hr style="margin:2px auto 2px auto;padding:0px;width:100%;">
                <small style="width: 100%;font-weight:normal;text-align:center;">{{ page_info("address").', '.page_info('phone') }}</small>
            </h5>
        </div>
    </header>
    @if (!empty($titulo))
        <div class="text-center">
            <h4
                style='margin:5px 0px;padding-bottom:10px;font-size:14px;text-transform:uppercase;text-decoration: underline;'>
                @php
                    echo $titulo;
                @endphp
            </h4>
        </div>
    @endif
    @if (!empty($descripcion))
        <div style="width:100%;font-size:10pt;text-align:justify;padding-bottom:10px;">
            <p>
                @php
                    echo $descripcion;
                @endphp
            </p>
        </div>
    @endif

    @if (count($table ?? []) > 0)
        <table border=1 cellspacing=0 width='100%'>
            <thead>
                <tr>
                        <th>N&ordm;</th>
                    @foreach ($table[0] as $header => $item)
                        <th>@php echo $header @endphp</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $nr = 1;
                @endphp
                @foreach ($table as $i => $value)
                    <tr>
                            <td>@php
                                echo $nr;
                                $nr++;
                            @endphp</td>
                        @foreach ($value as $header => $item)
                            <td>@php echo $item @endphp</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            <p>SEM DADOS PARA APRESENTAR</p>
        </div>
    @endif
</body>

</html>
