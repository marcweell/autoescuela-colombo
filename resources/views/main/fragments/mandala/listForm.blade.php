<div class="card">
    <div class="card-header">
        <div class="card-title"><h5>{{ __("Fases") }}<h5></div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7">
                <div class="text-sm-end">
                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="tablex table-centered w-100 dt-responsive">
                <thead class="">
                    <tr>
                        <th class="d-none d-md-table-cell">
                            <i class="fa fa-image"></i>
                        </th>
                        <th>{{ __('Nome') }}</th>  
                        <th>{!! __('Doa&ccedil;&atilde;o') !!}</th>  
                        <th style="width: 85px;"><i class='fa fa-cog'></i></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0, $n = 1; $i < count($mandala ?? []), ($item = @$mandala[$i]); $i++, $n++)
                    
                        
                    <tr>
                        <td class="d-none d-md-table-cell"> <img style="height: auto;width:100px" src="{{ tools()->photo($item->plan_icon)  }}" alt=""> </td>
                        <td style="{{ (empty($item->hex_color)?"":"color: ".$item->hex_color."!important;").($item->active==true?"":"text-decoration: line-through;") }}"> {{ $item->name }} </td> 
                        <td>{{ $item->currency_symbol . format_number($item->price ?? 0) }} </td>
                        <td class="table-action">
                            <a data-href="{{ route('web.app.mandala.participant.manage.index') }}"
                            data-id='{{ $item->id }}' class="btn btn-dark  l14k"> <i class="fa fa-eye"></i></a> 
                        </td>
                    </tr>






                    @endfor
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
