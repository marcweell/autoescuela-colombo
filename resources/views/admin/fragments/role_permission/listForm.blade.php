<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{!! __("conteudo") !!}<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">
                    <button type="button" class="btn btn-secondary mb-2">{{ __('Gerenciar Permissoes') }}</button>
                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">

            <div id="jstree-1">
                @foreach ($modules as $module)
                    <ul>
                        <li>
                            {{ $module->name }} 
                            <ul>
                                @foreach ($module->permissions as $item)
                                    <li data-jstree='{ "selected" : false }'>
                                        <a href="javascript:;">
                                            {{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                @endforeach
            </div>




            <script>
                $("#jstree-1").jstree({
                    plugins: [ "types"],
                    
                    types: {
                        default: {
                            icon: "dripicons-folder text-warning"
                        },
                        file: {
                            icon: "dripicons-document  text-warning"
                        }
                    }
                });
            </script>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
