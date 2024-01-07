<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Curso') }}</h4>

        <form action="{{ route('web.admin.course.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-4 mb-3">
                <label for="course_category_id" class="form-label">{{ __('Categoria') }}</label>
                <select name="course_category_id" class="form-control">
                    @foreach ($course_category ?? [] as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nombre...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="logo" class="form-label">{{ __('Logotipo') }}</label>
                <input type="file" name="logo" id="logo" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Precio') }}</label>
                <input type="number" name="price"  class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Precio Promo') }}</label>
                <input type="number" name="price_promo" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="document_type_id" class="form-label">{{ __('Documentos requeridos') }}</label>
                <select name="document_type_id[]" class="form-control select2" multiple>
                    @foreach ($document_type ?? [] as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">{{ __('Descripcion') }}</label>
                <textarea name="description" class="w-100 form-control" rows="5"></textarea>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
