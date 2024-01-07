<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Permiso') }}</h4>

        <form action="{{ route('web.admin.developer.permission.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Ingrese nombre...') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="code" id="code" class="form-control"
                    placeholder="{{ __('Ingrese nombre...') }}">
            </div>


            <div class="col-12 mb-3">
                <label for="module" class="form-label">{{ __('Modulo') }}</label>
                <select name="module_id" id="module_id" class="form-select">
                    @foreach ($module as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="description" class="form-label">{{ __('Descripcion') }}</label>
                <textarea  rows="5" class="w-100 form-control" name="description" id="description"></textarea>
            </div>



            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
