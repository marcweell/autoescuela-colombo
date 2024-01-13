<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Agregar Página') }}</h4>

        <form action="{{ route('web.admin.page.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-lg-4 mb-3">
                <label for="nombreTienda" class="form-label">Icono</label>
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
                <label for="imagen" class="form-label">Foto</label>
                <input class="form-control" type="file" name="image" accept="image/*">
            </div>
            <div class="col-lg-12 mb-3">
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
            <div class="col-lg-12 mb-3">
                <label for="pais" class="form-label">Paragrafos</label>
                <button type="button" class="btn btn-primary clonehim-alt" to="#row-paragrafo" elem-target="#paragrafos"><i
                        class="fa fa-plus" aria-hidden="true"></i></button>
            </div>

            <div class="row" id="row-paragrafo">

            </div>
            <div class="col-lg-12 mb-3">
                <label for="pais" class="form-label">Subcategoria</label>
                <button type="button" class="btn btn-primary clonehim-alt" to="#row-subcategories"
                    elem-target="#subcategories"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>

            <div class="row" id="row-subcategories">

            </div>

            <div class="col-12 pt-2">
                <button type="submit" class="btn btn-secondary  chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('Salvar') }}</button>
            </div>

        </form>

    </div> <!-- end card-body -->
</div>


<div id="paragrafos" class="d-none" style="display:none">
    <div class="col-md-6 im_dad">
        <div class="card bg-secondary mb-3">
            <div class="row card-body">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Icono</label>
                            <input name="paragraph[__CLONE_ID__][icon]" type="text" class="form-control iconpicker">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label">Titulo</label>
                            <input name="paragraph[__CLONE_ID__][title]" type="text" id="titulo" class="form-control">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Descripcion</label>
                            <textarea class="form-control"  name="paragraph[__CLONE_ID__][description]" rows="5"></textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="imagen" class="form-label">Foto</label>
                            <input class="form-control" type="file"  accept="image/*"  name="paragraph[__CLONE_ID__][image]">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-danger rm_dad"><i class="fa fa-times"></i></button>
                </div>

            </div>
        </div>
    </div>
</div>





<div id="subcategories" class="d-none" style="display:none">
    <div class="col-md-12 im_dad">
        <div class="card bg-success mb-3">
            <div class="row card-body">
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-danger rm_dad"><i class="fa fa-times"></i></button>
                    <button type="button" class="btn btn-info  clonehim-alt" to="#row-cursos-__CLONE_ID__"
                        elem-target="#cursos" data-clone-id="__CLONE_ID__"><i class="fa fa-plus"></i>
                        Cursos</button>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" id="titulo" class="form-control"  name="subcategory[__CLONE_ID__][title]">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" accept="image/*" class="form-control"  name="subcategory[__CLONE_ID__][image]">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Descripcion</label>
                            <textarea class="form-control"  name="subcategory[__CLONE_ID__][description]" rows="5"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" id="row-cursos-__CLONE_ID__">

            </div>
        </div>
    </div>
</div>






<div id="cursos" class="d-none" style="display:none">
    <div class="col-md-12 im_dad">
        <div class="row card-body">
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 text-end">
                <button class="btn btn-danger rm_dad"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="row card-body">
            <div class="col-md-3 mb-3">
                <label for="imagen" class="form-label">Categoria Curso</label>
                <input class="form-control" name="subcategory[__CLONE_ID__][curso][curso][]" >
            </div>
            <div class="col-md-3 mb-3">
                <label for="imagen" class="form-label">Numer Curso</label>
                <input class="form-control" name="subcategory[__CLONE_ID__][curso][nr][]" >
            </div>
            <div class="col-md-3 mb-3">
                <label for="imagen" class="form-label">Link PDF</label>
                <input class="form-control" name="subcategory[__CLONE_ID__][curso][link_pdf][]" >
            </div>
            <div class="col-md-3 mb-3">
                <label for="imagen" class="form-label">Link VIDEO</label>
                <input class="form-control" name="subcategory[__CLONE_ID__][curso][link_video][]" >
            </div>
            <div class="col-lg-12 mb-3">
                <label class="form-label">Descripcion</label>
                <textarea class="form-control" name="subcategory[__CLONE_ID__][curso][description][]" rows="5"></textarea>
            </div>

        </div>
    </div>
</div>











<script>
    function ll() {

    $(".clonehim-alt").click(function() {
        if (cloning == true) {
            return;
        }

        var html = $(this.getAttribute("elem-target")).html();

        if (this.hasAttribute("data-clone-id")) {
            var id = this.getAttribute("data-clone-id");
        } else {
            var id = Tool.encode(Date.now(), 1);
        }

        for (let index = 0; index < 11; index++) {
            html = html.replace("__CLONE_ID__", id);

        }
        console.log(this.getAttribute("to"));

        $(this.getAttribute("to")).append(
            html
        );

        cloning = true;

        setTimeout(function() {
            cloning = false;
            app.listenner.listen();
            ll();
        }, 300);
    });
    }
    ll();
</script>
