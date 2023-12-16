 <div class="card">
     <div class="card-header">
         <div class="card-title">
             <h5>Informacoes de Pagina<h5>
         </div>
     </div> 
 </div><!-- end card-->


 <ul id="job-container" class="list-unstyled row">

     @for ($i = 0, $n = 1; $i < count($page_info ?? []), ($item = @$page_info[$i]); $i++, $n++)
         <li class="col-xxl-3 col-lg-6">
             <div class="card m-1 shadow-none border">
                 <div class="p-3">
                         <div class="row align-items-center">
                             <div class="col">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i class="fa fa-globe font-16"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col ps-0">
                                        <h5>{{ $item->name }}</h5>
                                        <small class="mb-0 font-10">
                                            {{ empty($item->content) ? '[' . __('Nao Definido') . ']' : ($item->content_type !== 'rich_text' ? (strlen($item->content) > 10 ? '['.__("Ver Detalhes").']' : $item->content) : '['.__("Ver Detalhes").']') }}
                                        </small>
                                    </div>
                                </div>
                             </div>
                             <div class="col text-center mt-2">
                                 <a data-href="{{ route('web.admin.page_info.detail.index') }}"
                                     data-id='{{ $item->id }}' class="btn btn-secondary btn-sm l14k"><i
                                         class="fa fa-eye"></i></a>
                                 <a data-href="{{ route('web.admin.page_info.update.index') }}"
                                     data-id='{{ $item->id }}' class="btn btn-secondary btn-sm l14k"><i
                                         class="fa fa-pen-nib"></i></a>
                             </div>
                         </div> <!-- end row -->
                 </div> <!-- end .p-2-->
             </div> <!-- end col -->
         </li>
     @endfor

 </ul>


 <div class="row">
     <div class="holder">
     </div>
 </div>


 <script defer>
     setTimeout(function() {

         $(function() {
             $(".holder").jPages({
                 containerID: "job-container",
                 perPage: 16,
                 minHeight: false,
                 previous: "← Anterior",
                 next: "Proximo →",
                 startPage: 1,
                 midRange: 5,
                 startRange: 1,
                 endRange: 1,
                 keyBrowse: false,
                 scrollBrowse: false,
                 pause: 0,
                 clickStop: false,
                 delay: 0,
                 direction: "forward", // backwards || auto || random || 
                 fallback: 400,
                 callback: function() {
                     // $([document.documentElement, document.body]).animate({
                     //     scrollTop: ($("#job-container").offset().top-600)
                     // }, 00);
                 }

             });
         })
     }, 300);
 </script>
