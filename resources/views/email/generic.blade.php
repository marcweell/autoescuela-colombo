@extends('email.template')
@section('content')

<tr>
    <div class="text" style="padding: 0 2.5em; text-align: justify;">
{!! $content !!}


    </div>
</tr>
@endsection
