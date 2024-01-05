<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Menu') }}</h4>

        <form action="{{ route('web.admin.page.site_menu.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $site_menu->id }}">

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nombre...') }}" value="{{ $site_menu->name }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Rota') }}</label>
                <select class="form-control" name="route" id="">

                    @foreach (Route::getRoutes() as $item)
                        @if (str_ends_with($item->getName(), '.do') or
                            str_starts_with($item->getName(), 'ignition.') or
                            empty($item->getName()))
                            @php
                                continue;
                            @endphp
                        @endif
                        <option {{ $item->getName() == $site_menu->route ? 'selected' : '' }} value="{{ $item->getName() }}">{{ $item->getName() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icone') }}</label>
                <input type="text" name="icon_class" id="name" class="form-control iconpicker"  autocomplete="off" value="{{ $site_menu->icon_class }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Pai') }}</label>
                <select class="form-control" name="parent_menu_id">
                    <option value="">Nenhum</option>
                    @foreach ($site_menus as $item)
                        <option {{ $item->id == $site_menu->parent_menu_id ? 'selected' : '' }}
                            value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Indice') }}</label>
                <input type="number" step="0.0001" name="_index" id="name" class="form-control"
                    placeholder="{{ __('Digite o nombre...') }}" value="{{ $site_menu->order_index }}">
            </div>



<div class="col-md-12">
    <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
</div>
        </form>

    </div> <!-- end card-body -->
</div>
