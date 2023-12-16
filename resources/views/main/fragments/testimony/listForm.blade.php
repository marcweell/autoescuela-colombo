<div class="card">
    <div class="card-body">


        <div class="rounded border border-dark mb-4 px-3 pb-3">

            <div class="w-100 text-start text-dark pt-3">
                <img class="rounded-circle mb-4" src="{{ tools()->photo(Auth::user()->profile_picture) }}" style="width: 50px;" /> <b style="position: relative; top: -8px; left: 6px;" class="">{{ implode(" ",[Auth::user()->name,Auth::user()->last_name]) }}</b>
            </div>
            <form action="{{ route('web.app.testimony.add.do') }}" class="form_ parent-load-- row" method="post">
                <input type="hidden" name="points" value="5">
                <textarea name="message" class="w-100 rounded p-2 border-0 border-bottom mb-2" placeholder="Deixe aqui o seu depoimento" rows="2"></textarea>
                <div class="w-100 text-end">
                    <button class="btn btn-primary"><i class="fa fa-paper-plane mx-1"></i>Enviar</button>
                </div>
            </form>
        </div>


        <div class="table-responsive">
            <table class="table table-sm w-100">
                <tbody>
                    @foreach ($testimony as $item)
                        
                        <tr>
                            <td class="pt-2">


                                <div class="w-100 text-start text-dark">
                                    <img class="rounded-circle mb-4" src="{{ tools()->photo($item->user_profile_picture) }}" style="width: 50px;" /> <b style="position: relative; top: -8px; left: 6px;" class="">{{ $item->user_full_name }}</b>
                                </div>

                                <div class="w-100 text-start">

                                    <p>
                                        {{ $item->message }}
                                    </p>
                                    <h6>
                                        {{ tools()->date_convert($item->created_at) }}
                                    </h6>

                                </div>
 

                            </td> 
                        </tr>
                        @endforeach

                        <tr>
                            <td class="text-center"> 
                                <button data-href="{{ route("web.app.testimony.index") }}" data-payloads="{{ json_encode(['limit'=>(($limit??0)+2)]) }}" style="width:80%" class="btn btn-primary border-radius-30 l14k">{{ __("Ver Mais") }}</button>
                            </td> 
                        </tr>
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
