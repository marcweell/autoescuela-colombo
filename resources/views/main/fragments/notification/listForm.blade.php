<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{!! __("Notificacoes") !!}<h5></div>
    </div>
    <div class="card-body">
 

        <div class="table-responsive">
            <table class="table table_ table-xl table-sm table-centered w-100 dt-responsive">
                <thead class="">
                    <tr> 
                        <th>{{ __('') }}</th>
                        <th style="width: 45px;"><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($notification ?? []), ($item = @$notification[$i]); $i++, $n++)
                        <tr> 
                            <td> 
                                <div class="timeline-box"> 
                                    <p class="text-muted"><small>{{ tools()->date_convert($item->created_at) }}</small></p>
                                    <p>{{ $item->message }}</p>

                                    <!--a href="javascript: void(0);" class="btn btn-sm btn-secondary">👍 17</a--> 
                                </div>
                            
                            </td>  
                            <td class="table-action"> 
                                <a data-href="{{ route('web.app.notification.remove.do') }}"
                                    data-id='{{ $item->id }}' class="btn btn-dark l14k prompt"
                                    data-title="Remover"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
