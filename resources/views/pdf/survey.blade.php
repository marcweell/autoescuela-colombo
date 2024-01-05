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
            <img width="100px" style='margin-bottom:6px;diplay:block;'
                src="{{ tools()->filetobase64('public/essential/img/logo.png') }}" alt="">
            <h4 style='margin:2px;'>
                {{ $survey->course_name }}
            </h4>
            <h5 style='margin:2px auto;;'>
                <hr style="margin:2px auto 2px auto;padding:0px;width:100%;">
                <small style="width: 100%;font-weight:normal;text-align:center;"></small>
            </h5>
        </div>
    </header>
    <div class="text-center">
        <h4 style='margin:5px 0px;padding-bottom:10px;font-size:14px;text-transform:uppercase;'>
            {{ $survey->name }}
        </h4>
    </div>
    <div style="width:100%;font-size:10pt;text-align:justify;padding-bottom:10px;">
        <p>
            {{ $survey->description }}
        </p>
    </div>
    <div style="width:100%;font-size:10pt;text-align:justify;padding-bottom:10px;">
        @foreach ($data as $item)
            <div style="width:50%;font-size:10pt;text-align:justify;padding-bottom:10px; float: left;">
                <label style="width:100%;">{{ $item->name }}:</label>
                <div style="padding:10px;"></div>
                <hr style="width: 90%">
            </div>
        @endforeach
    </div>
    @php
        $nr = 1;
        $line = '<tr><td><hr></td></tr>';
    @endphp
    @foreach ($question as $item)
        <table border=0 cellspacing=0 width='100%' style="margin-top: 40px">
            <thead>
                <tr style="text-align: left">
                    <th style="text-align: left">{{ $nr }}. {{ $item->question }}</th>
                </tr>
            </thead>
            <tbody>
                @switch($item->question_type)
                    @case('best-worst')
                        <tr>
                            <td>
                                <span><input type="radio" name=""> Positivo</span> <span><input type="radio"
                                        name=""> Negativo</span>
                            </td>
                        </tr>
                    @break

                    @case('single-choice-radio')
                    @case('multiple-choice')
                        <tr>
                            <td>
                                @foreach ($option as $q)
                                    @php
                                        if ($q->survey_question_id !== $item->id) {
                                            continue;
                                        }
                                    @endphp
                                    <span><input type="checkbox" name=""> {{ $q->option }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @break
                    @default
                    <tr>
                        <td>
                            @for ($i = 0; $i < $item->_lines ?? 3; $i++)
                              <hr>
                            @endfor
                        </td>
                    </tr>
                @endswitch
            </tbody>
        </table>
        @php
            $nr++;
        @endphp
    @endforeach

</body>

</html>
