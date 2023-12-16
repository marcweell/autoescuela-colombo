<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Mensagem') }}</h4>

        <input type="hidden" name="id" value="{{ $message->id }}">
        <div class="col-md-12 mb-3">
            <label for="name" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" id="name" class="form-control" value="{{ $message->email }}">
        </div>
        <div class="col-12 mb-5">
            <label for="">Conteudo</label>
            {{ $message->message }}
        </div>

        <div class="col-12">
            <hr>
            <a data-href="{{ route('web.admin.message.reply.index') }}" data-id='{{ $message->id }}'
                class="btn btn-secondary btn-sm l14k"><i class="fa fa-reply"></i></a>
            <a data-href="{{ route('web.admin.message.detail.index') }}" data-id='{{ $message->id }}'
                class="btn btn-secondary btn-sm l14k"><i class="fa fa-eye"></i></a>
            <a data-href="{{ route('web.admin.message.remove.do') }}" data-id='{{ $message->id }}'
                class="btn btn-secondary btn-sm l14k prompt" data-title="Remover Mensagem"><i
                    class="fa fa-trash"></i></a>
        </div>


    </div> <!-- end card-body -->
</div>
