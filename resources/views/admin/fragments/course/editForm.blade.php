<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Curso') }}</h4>

        <form action="{{ route('web.admin.course.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $course->id }}">

            <div class="col-md-4 mb-3">
                <label for="code" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="code" id="code" class="form-control"
                    placeholder="{{ __('Ingrese Codigo...') }}" value="{{ $course->code }}">
            </div>
            <!--div class="col-md-4 mb-3">
                <label for="course_category_id" class="form-label">{{ __('Categoria') }}</label>
                <select name="course_category_id" class="form-control">
                    @foreach ($course_category as $item)
                        <option value="{{ $item->id }}"
                            {{ $course->course_category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div-->
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Ingrese nombre...') }}" value="{{ $course->name }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="logo" class="form-label">{{ __('Logo') }}</label>
                <input type="file" name="logo" id="logo" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="cover_photo" class="form-label">{{ __('Foto de Capa') }}</label>
                <input type="file" name="cover_photo" id="cover_photo" class="form-control">
            </div>

            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">{{ __('Descripcion') }}</label>
                <textarea name="description" class="w-100 form-control" rows="5"> {{ $course->description }}</textarea>
            </div>
            <div class="col-12">
                <hr>
            </div>



            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>

