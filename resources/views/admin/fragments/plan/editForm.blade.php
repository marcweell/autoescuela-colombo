<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Plano') }}</h4>

        <form action="{{ route('web.admin.settings.plan.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $plan->id }}">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    value="{{ $plan->name }}">
            </div>

            <div class="col-6 col-lg-6 mb-3">
                <label for="name" class="form-label">{{ __('Nivel') }}</label>
                <select name="level" id="level" class="form-control">
                    @for ($i = -5; $i < 31; $i++)
                        <option {{ $i == $plan->level ? 'selected' : '' }} value="{{ $i }}">
                            {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-3 col-lg-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <select name="currency_id" id="currency_id" class="form-control">
                    @foreach ($currency as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $plan->currency_id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="col-9 col-lg-6 mb-3">
                <label for="name" class="form-label">{{ __('Preco') }}</label>
                <input type="number" name="price" required class="form-control" value="{{ $plan->price }}">
            </div>
            <div class="col-12 mb-3">
                <textarea name="description" rows="5" class="form-control">{!! $plan->description !!}</textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">{{ __('Cor') }}</label>
                <input autocomplete="false" type="text" name="hex_color" id="hex_color" required id="name" class="form-control"
                    value="{{ $plan->hex_color }}">
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-check form-check-inline">
                    <input {{ $plan->active == true ? "checked" : "" }} type="checkbox" name="active" class="form-check-input" id="customCheck3">
                    <label class="form-check-label" for="customCheck3">Ativo</label>
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>

<script>
    $(function(){

    var colorInput = document.querySelector('#hex_color');
    var hueb = new Huebee(colorInput, {
        // options
        setBGColor: true,
        saturations: 2,
    });
    });
</script>
