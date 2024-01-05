<div class="card">

    <div class="card-body">
        <h4 class="header-title">{{ __('Editar Curso') }}</h4>

        <form action="{{ route('web.admin.course.update.do') }}" class="form_ parent-load row" method="post">
            <input type="hidden" name="id" value="{{ $course->id }}">

            <div class="col-md-8 mb-3">
                <label for="user_id" class="form-label">{{ __('Usuario') }}</label>
                <select name="user_id" class="form-control">
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}" {{ $course->creator == $item->id ? 'selected' : '' }}>
                            {{ $item->name . ' ' . $item->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="code" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="code" id="code" class="form-control"
                    placeholder="{{ __('Digite o Codigo...') }}" value="{{ $course->code }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="course_category_id" class="form-label">{{ __('Categoria') }}</label>
                <select name="course_category_id" class="form-control">
                    @foreach ($course_category as $item)
                        <option value="{{ $item->id }}"
                            {{ $course->course_category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" name="name" required id="name" class="form-control"
                    placeholder="{{ __('Digite o nome...') }}" value="{{ $course->name }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="website" class="form-label">{{ __('Website') }}</label>
                <input type="text" name="website" id="website" class="form-control"
                    placeholder="{{ __('Digite o Website...') }}" value="{{ $course->website }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="postal_code" class="form-label">{{ __('Codigo Postal') }}</label>
                <input type="text" name="postal_code" id="postal_code" class="form-control"
                    placeholder="{{ __('Digite o Codigo Postal...') }}" value="{{ $course->postal_code }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="logo" class="form-label">{{ __('Logotipo') }}</label>
                <input type="file" name="logo" id="logo" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="cover_photo" class="form-label">{{ __('Foto de Capa') }}</label>
                <input type="file" name="cover_photo" id="cover_photo" class="form-control">
            </div>

            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">{{ __('Descricao') }}</label>
                <textarea name="description" class="w-100 form-control" rows="5"> {{ $course->description }}</textarea>
            </div>
            <div class="col-12">
                <hr>
            </div>

            <div class="col-md-12">
                <h4 class="row">
                    <div class="col-6">
                        {{ __('Contactos') }} </div>
                        <div class="col-6 text-end">
                            <button type="button" role="button" to="#course_contacts"
                        elem-target="#og_course_contacts" class="clonehim btn btn btn-primary float-right chl_loader"><i
                            class="fa fa-plus"></i></button>
                        </div>
                </h4>
                <hr>
                <div id="course_contacts">
                    @foreach ($course->contact as $contact)
                        <div class="im_dad row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Tipo de Contacto') }}</label>
                                    <select name="contact_type[]" class="form-control">
                                        @foreach ($contact_type as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $contact->contact_type_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Contacto') }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="contact[]"
                                            value="{{ $contact->contato }} ">
                                        <button class="btn btn-primary rm_dad" type="button"><i
                                                class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="dropdown-divider mt-3"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="permalink" class="form-label">{{ __('Codigo') }}</label>
                <input type="text" name="permalink" id="permalink" class="form-control"
                    placeholder="{{ __('Digite o Codigo...') }}" value="{{ $course->permalink }}">
            </div>
            <div class="col-12">
                <div class="alert alert-info" role="info">
                    <h4 class="alert-heading">Importante!</h4>
                    <hr>
                    <p>Se nao selecionar nenhuma foto de cap ou logotipo, estes nao serao alterados.</p>
                </div>
            </div>


            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i class="fa fa-save p-1"></i>{{ __('guardar') }}</button>
            </div>
        </form>

    </div> <!-- end card-body -->
</div>


<div style="display:none;" id="og_course_contacts">
    <div class="im_dad row">

        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">{{ __('Tipo de Contacto') }}</label>
                <select name="contact_type[]" class="form-control">
                    @foreach ($contact_type as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label class="form-label">{{ __('Contacto') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="contact[]">
                    <button class="btn btn-primary rm_dad" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="dropdown-divider mt-3"></div>
        </div>


    </div>
</div>
