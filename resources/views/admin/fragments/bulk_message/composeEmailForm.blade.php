<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Enviar Email') }}</h4>

        <form action="{{ route('web.admin.bulk_message.email.compose.send') }}" class="form_ parent-load row" method="post">


            <div class="col-md-6 mb-3">
                <label for="recipient" class="form-label ">{{ __('Emails') }}</label>
                <select name="recipient[]" class="select2tag form-control" multiple>
                    @foreach ($recipients as $item)
                        <option selected value="{{ $item->id }}">{{ $item->email }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="mailsubject" class="form-label">Sujeto</label>
                <input type="text" id="mailsubject" class="form-control" placeholder="Your subject">
            </div>
            <div class="write-mdg-box mb-3">
                <label class="form-label">Mensaje</label>
                <textarea name="body" class="w-100 form-control textarea" rows="5"></textarea>
            </div>


            <div class="col-md-6 pr-5">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-paper-plane p-1"></i>{{ __('Enviar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
