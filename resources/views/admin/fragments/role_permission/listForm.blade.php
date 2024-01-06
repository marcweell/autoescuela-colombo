<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{!! __("Permisos") .' - '. $role->name !!}<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7">
                <div class="float-end">
                    <button type="button" data-href="{{ route("web.admin.user.role.role_permission.update.index") }}" class="btn btn-sm btn-primary mb-2 _link_" data-id="{{ $role->id }}">{{ __('Gerir Permisos') }}</button>
                </div>
            </div><!-- end col-->
        </div>

        <ul>
            @foreach ($modules??[] as $item)

            <h4>{{ $item->name }}</h4>

            @foreach ($item->permissions as $permission)

            <li>{{ $permission->permission_name }}</li>

            @endforeach

            <li>
                <hr class="mb-5">
            </li>

            @endforeach
        </ul>














    </div> <!-- end card-body-->
</div> <!-- end card-->
