<div class="intro-video">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if (!empty(page_info('tutorial-video')))
                    <iframe width="100%" height="595" src="{{ page_info('tutorial-video') }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                @endif
            </div>
            <div class="col">
                <ul>

                    @foreach (page_info('tutorial-text') as $item)
                         
                        <li>
                            <h1><i class="fa fa-file p-2"></i><a target="_blank"
                                    href="{{ url('storage/files/' . $item->content) }}">{{ empty($item->child_index)?"BAIXAR TUTORIAL EM
                                    PDF": $item->child_index }}</a></h1>
                        </li> 


                    @endforeach



                </ul>
            </div>
        </div>
    </div>

</div>
