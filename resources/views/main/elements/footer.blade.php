<div class="bottom section-padding triangle-top-dark triangle-bottom-dark">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="bottom-logo"><img class="pb-3" src="{{ url('public/assets/images/logoh.png') }}" alt="">
                    <p>{{ page_info("about.min") }}</p>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12">
                <div class="bottom-widget">
                    <h4 class="widget-title">{{ __("Siga-nos") }}</h4>
                    <ul class="d-flex">
                        @if (!empty(page_info("social.facebook")))
                        <li><a href="{{ route('web.public.about.index') }}" class="btn btn-dark m-1"><i class="fa fa-circle"></i></a></li>
                        @endif
                        @if (!empty(page_info("social.instagram")))
                        <li><a href="{{ route('web.public.about.index') }}" class="btn btn-dark m-1"><i class="fa fa-circle"></i></a></li>
                        @endif
                        @if (!empty(page_info("social.whatsapp")))
                        <li><a href="{{ route('web.public.about.index') }}" class="btn btn-dark m-1"><i class="fa fa-circle"></i></a></li>
                        @endif
                       
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="bottom-widget">
                    <h4 class="widget-title">{{ __("Links Importantes") }}</h4>
                    <ul>
                        <li><a href="{{ route('web.public.about.index') }}" class="text-capitalize">{{ __("sobre") }}</a></li>
                        <li><a href="{{ route('web.public.plan.index') }}" class="text-capitalize">{{ __("fases") }}</a></li>
                        <li><a href="{{ route('web.public.contact.index') }}"  class="text-capitalize">{{ __("contato") }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="bottom-widget">
                    <h4 class="widget-title">Mais</h4>
                    <ul>
                        <li><a href="{{ route('web.public.terms.index') }}" class="text-capitalize">{{ __("termos de uso") }}</a></li>
                        <li><a href="{{ route('web.public.privacy.index') }}" class="text-capitalize">{{ __("politicas") }}</a></li>
                        <li><a href="{{ route('web.public.faq.index') }}" class="text-capitalize">{{ __("perguntas frequentes") }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                <div class="bottom-widget">
                    <h4 class="widget-title text-uppercase">{{ __("newsletter") }}</h4>
                    <div class="newsletter">
                        <form class="form_ prompt" method="post"
                            action="{{ route('web.public.api.subscribe') }}">
                            <div class="input-group">
                                <input class="form-control" type="email" name="email" placeholder="Email"> 
                                <button class="btn btn-primary chl_loader" type="submit"  class="text-uppercase"> {{ __("inscrever-se") }}
                                </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="copyright text-center text-white">
                    <p class="text-white"> Feito com amor | Copyright &copy; {{ config('app.name') }} | Todos os direitos reservados </p>
                </div>
            </div> 
        </div>
    </div>
</div>