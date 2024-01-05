<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Curso') }}</h4>

        <form action="{{ route('web.admin.course.add.do') }}" class="form_ parent-load row" method="post">
 
            <div class="col-md-4 mb-3">
                <label for="course_category_id" class="form-label">{{ __('Categoria') }}</label>
                <select name="course_category_id" class="form-control">
                    @foreach ($course_category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome...') }}">
            </div> 
            <div class="col-md-4 mb-3">
                <label for="logo" class="form-label">{{ __('Logotipo') }}</label>
                <input type="file" name="logo" id="logo" class="form-control">
            </div> 

            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">{{ __('Descricao') }}</label>
                <textarea name="description" class="w-100 form-control" rows="5"></textarea>
            </div>
 
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
