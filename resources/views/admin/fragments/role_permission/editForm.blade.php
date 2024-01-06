<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Gerir Permisos') }}</h4>

        <form action="{{ route('web.admin.user.role.role_permission.update.do') }}" class="form_ --parent-load row"
            method="post">
            <input type="hidden" name="role_id" value="{{ $role->id }}">


            <div class="accordion" id="accordionExample">

                @foreach ($modules as $module)
                    <div class="accordion-item">
                        <h2 class="accordion-header p-0 border-0" id="heading{{ $module->code }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $module->code }}" aria-expanded="false"
                                aria-controls="collapse{{ $module->code }}">
                                {{ $module->name }}
                            </button>
                        </h2>
                        <div id="collapse{{ $module->code }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $module->code }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table table-centered table-striped table-hover">
                                    @foreach ($module->permissions as $permission)
                                        <tr>
                                            <td>
                                                <h4>{{ $permission->name }}</h4>
                                            </td>
                                            <td width='50px'>
                                                <div class="form-check">
                                                    <input {{ in_array($permission->id, $permission_ids) == true ? 'checked' : '' }} class="form-check-input" type="checkbox" name="permission[{{ $permission->id }}]">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach




            </div>

            <div class="row">



                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary  --chl_loader"><i
                            class="fa fa-save p-1"></i>{{ __('guardar') }}</button>
                </div>


            </div>







        </form>

    </div> <!-- end card-body -->
</div>
