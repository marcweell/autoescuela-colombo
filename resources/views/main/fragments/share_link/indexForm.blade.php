<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ config('app.name') }}</h4>
        <div class="row">
            <div class="col-md-9 mb-3">
                <label for="name" class="form-label">{{ __('Partilhe esse link com os seus amigos') }}</label>
                <div class="input-group">
                    <input value="{{ $link }}" class="form-control">
                    <div class="input-group-append">
                        <button id="copyl" role="button" data-content="{{ $link }}"
                            class="btn btn-dark" type="button"><i
                                class="fa fa-copy"></i></button>
                    </div>
                </div>
    
            </div>
        </div>
    </div> <!-- end card-body -->
</div>

<script>
    $("#copyl").click(function() {
        let text = this.getAttribute("data-content");


        navigator.clipboard.writeText(text)
            .then(function() {
                output.notify('{{ __("Link Copiado para area de transferencia") }}');
            })
            .catch(function(err) {
                output.notify(err.getMessage());
            });
    });
</script>
