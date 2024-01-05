
<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
                <a data-href="{{ route('web.admin.page.gallery.add.index') }}" data-id="-1" class="btn btn-primary mb-2 _link_"><i
                        class="fa fa-plus-circle me-2"></i> {{ __('Adicionar Fotos') }}</a>
            </div>
        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->

<div class="card">
    <div class="card-body">

        <!-- Gallery start -->
        <div class="photos-galley gallery">
            <!-- Row start -->
            <div class="row  g-2">
                @for ($i = 0, $n = 1; $i < count($gallery ?? []), ($item = @$gallery[$i]); $i++, $n++)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ url('storage/files/gallery/original/' . $item->archive) }}" target="_blank" class="effects">
                            <img src="{{ url('storage/files/gallery/square/' . $item->archive) }}" class="img-fluid" alt="Uni Pro Admin">
                            <div class="overlay">
                                <span class="expand">+</span>
                            </div>
                        </a>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn w-100 btn-warning _link_ prompt" data-id="{{ $item->id }}"
                                    data-href="{{ route('web.admin.page.gallery.remove.do') }}"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn w-100 btn-primary _link_ prompt" data-id="{{ $item->id }}"
                                    data-href="{{ route('web.admin.page.gallery.remove.do') }}"><i
                                        class="fa fa-edit"></i></button>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-dark w-100 p-3 mt-1" target="_blank" role="button" onclick="window.open('{{ url('storage/files/gallery/original/' . $item->archive) }}', '_blank').focus()"><i
                                        class="fa fa-download"></i></button>
                            </div>
                        </div>
                    </div>
                @endfor




            </div>
            <!-- Row end -->
        </div>
        <!-- Gallery end -->

    </div>
</div>
 <script>
    $(function(){
        baguetteBox.run('.photos-galley', {
	});
    });
 </script>
