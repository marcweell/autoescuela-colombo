<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Registro de Menu') }}</h4>

        <form action="{{ route('web.admin.page.site_menu.add.do') }}" class="form_ parent-load row" method="post">

            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nombre...') }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Icone') }}</label>
                <input type="text" name="icon_class" id="name" class="form-control iconpicker"  autocomplete="off">
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Preferir') }}</label>
                <select class="form-control" name="prefer">
                    <option value="uri">URI</option>
                    <option value="route">ROTA</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Rota') }}</label>
                <select class="form-control select2tg" name="route" id="">

                    @foreach (Route::getRoutes() as $item)
                        @if (str_ends_with($item->getName(), '.do') or $item->methods[0] == 'POST' or str_ends_with($item->getName(), '.') or !str_starts_with($item->getName(), 'web.public.') or str_starts_with($item->getName(), 'ignition.') or empty($item->getName()))
                            @php
                                continue;
                            @endphp
                        @endif
                        <option value="{{ $item->getName() }}">{{ $item->getName() . ' (' . $item->methods[0]. ')' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Rota') }}</label>
                <select class="form-control select2tg" name="uri" id="">

                    @foreach (Route::getRoutes() as $item)
                        @if (str_ends_with($item->getName(), '.do') or $item->methods[0] == 'POST' or str_ends_with($item->getName(), '.') or !str_starts_with($item->getName(), 'web.public.') or str_starts_with($item->getName(), 'ignition.') or empty($item->getName()))
                            @php
                                continue;
                            @endphp
                        @endif
                        <option value="{{ $item->uri() }}">{{ $item->uri() . ' (' . $item->methods[0]. ')' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Indice') }}</label>
                <input type="number" name="_index" id="name" value="0" class="form-control"
                    placeholder="{{ __('Digite o nombre...') }}">
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>
