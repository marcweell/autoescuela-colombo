<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Cidade') }}</h4>

        <form action="{{ route('web.admin.settings.geo.city.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $city->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control" value="{{ $city->name }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $city->code }}">
            </div>

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <select name="country_id" id="country_id" class="form-control">
                    @foreach ($country as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $city->country_id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            
<div class="col-md-12">
    <button type="submit" class="btn btn-secondary  chl_loader"><i class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
</div> 
        </form>

    </div> <!-- end card-body -->
</div>
