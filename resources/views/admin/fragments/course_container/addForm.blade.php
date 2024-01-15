<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Genero') }}</h4>

        <form action="{{ route('web.admin.course_container.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-12 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control" placeholder="{{ __('Ingrese nombre...') }}">
            </div>

        </form>

    </div> <!-- end card-body -->
</div>
