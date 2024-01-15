<form action="">





    <div class="card">
        <div class="accordion" id="accordionExample">


            @foreach ($course_category ?? [] as $item)
                @php
                    $code = '_' . $item->code;
                    $courses_ = explode(',', $item->courses ?? '');
                @endphp



                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#{{ $code }}" aria-expanded="false"
                            aria-controls="{{ $code }}">
                            {{ $item->name }}
                        </button>
                    </h2>
                    <div id="{{ $code }}" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">


                                @foreach ($courses as $value)


                                @if (!in_array($value->id,$courses_))
                                @continue
                                @endif


                                <div class="row mb-3">

                                <div class="col-md-4">
                                    <div class="form-group p-1 bg-success text-white">
                                        {{ $value->name }}
                                    </div>
                                    <div class="form-group my-1">
                                        <input type="text" class="form-control" placeholder="Titulo">
                                    </div>
                                    <div class="form-group my-1">
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="form-group my-1">
                                        <input type="text" class="form-control" placeholder="URL VIDEO">
                                    </div>
                                    <div class="form-group my-1">
                                        <input type="text" class="form-control" placeholder="URL FILE">
                                    </div>

                                </div>


                                <div class="col-md-8">


                                    <label for="" class="form-label">Description</label>
                                    <textarea name="description" cols="30" class="form-control textareaI"></textarea>


                                </div>











                            </div>










                            <hr>





                                @endforeach








                        </div>
                    </div>
                </div>
            @endforeach










        </div>



        <div class="row py-3 px-3">

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary chl_loader"><i
                        class="fa fa-save p-1"></i>{{ __('salvar') }}</button>
            </div>
        </div>
    </div> <!-- end card-->

















</form>
