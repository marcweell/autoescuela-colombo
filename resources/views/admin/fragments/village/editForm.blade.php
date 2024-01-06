<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Aldea') }}</h4>

        <form action="{{ route('web.admin.settings.geo.village.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $village->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control" value="{{  $village->name }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="code" id="code" class="form-control" value="{{  $village->code }}">
            </div>


            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <select name="city_id" id="city_id" class="form-select">
                    @foreach ($city as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $village->city_id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

<div class="col-md-12">
    <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
</div>
        </form>

    </div> <!-- end card-body -->
</div>
