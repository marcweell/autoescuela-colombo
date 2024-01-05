<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Enviar SMS') }}</h4>

        <form action="{{ route('web.admin.bulk_message.sms.compose.send') }}" class="form_ parent-load row" method="post">



            <div class="col-md-6 mb-3">
                <label for="company_id" class="form-label ">{{ __('Empresa') }}</label>
                <select name="company_id" class="select2rmt" data-toggle="select2">
                    @foreach ([] as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="recipients" class="form-label">{{ __('Remententes') }}</label>
                <select name="recipients[]" class="form-control select2tag" data-toggle="select2" multiple></select>
            </div>


            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">{{ __('Mensagem') }}</label>
                <textarea name="body" class="w-100 form-control" rows="5"></textarea>
            </div>


            <div class="col-md-6 pr-5">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-paper-plane p-1"></i>{{ __('Enviar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
