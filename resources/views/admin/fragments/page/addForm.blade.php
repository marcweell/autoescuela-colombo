<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Cadastro de Usuario') }}</h4>

        <form action="{{ route('web.admin.page.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-lg-4 mb-3">
                <label for="nombreTienda" class="form-label">Icona</label>
                <input type="text" name="icon" class="form-control iconpicker">
            </div>

            <div class="col-lg-4 mb-3">
                <label for="example-color" class="form-label">Color</label>
                <input class="form-control  hex_color" type="text" name="color" value="#727cf5">
            </div>

            <div class="col-md-4 mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" name="page_category_id" id="id_categoria">
                    <option value="">Selecciona una categoria</option>
                    @foreach ($page_category ?? [] as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="form-label">Precio</label>
                <input class="touchspin" type="text" value="0" name="price">
            </div>
            <div class="col-lg-4 mb-3">
                <label class="form-label">Precio de promocion</label>
                <input class="touchspin" type="text" value="0" name="price_promo">
            </div>
            <div class="col-lg-4 mb-3">
                <label for="direccionTienda" class="form-label">Titulo</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="col-lg-4 mb-3">
                <label for="pais" class="form-label">Subtitulo</label>
                <input type="text" name="subtitle" class="form-control">
            </div>
            <div class="col-lg-4 mb-3">
                <label for="pais" class="form-label">Prefacio</label>
                <input type="text" name="preface" class="form-control">
            </div>
            <div class="col-lg-4 mb-3">
                <label for="pais" class="form-label">Descripcion</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="col-lg-4 mb-3">
                <label for="imagen" class="form-label">Foto</label>
                <input class="form-control" type="file" name="image" accept="image/*">
            </div>
            <div class="col-lg-12 mb-3">
                <label for="pais" class="form-label">Paragrafos</label>
                <button type="button" class="btn btn-primary" onclick="addParagrafoContent();"><i class="uil-plus"
                        aria-hidden="true"></i></button>
            </div>
            <div id="addparagrafo"></div>
            <div class="col-lg-12 mb-3">
                <label for="pais" class="form-label">Subcategoria</label>
                <button type="button" class="btn btn-primary" onclick="addSubcategoriaContent();"><i class="uil-plus"
                        aria-hidden="true"></i></button>
            </div>
            <div id="addsubcategoria"></div>

            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>

<script>
    $('.iconpicker').iconpicker();
</script>
