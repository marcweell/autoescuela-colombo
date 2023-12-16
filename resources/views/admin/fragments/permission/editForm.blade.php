<div class="card">
    
    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Permissao') }}</h4>

        <form action="{{ route('web.admin.developer.permission.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $permission->id }}">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control" value="{{  $permission->name }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="code" id="code" class="form-control" value="{{  $permission->code }}">
            </div>
            

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <select name="module_id" id="module_id" class="form-control">
                    @foreach ($module as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $permission->module_id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">{{ __('Descricao') }}</label>
                <textarea rows="5" class="w-100 form-control" name="description" id="description">{{ $permission->description }}</textarea>
            </div>




            
<div class="col-md-12">
    <button type="submit" class="btn btn-secondary  chl_loader"><i class="fa fa-save p-1"></i>{{ __('Guardar') }}</button>
</div> 
        </form>

    </div> <!-- end card-body -->
</div>
