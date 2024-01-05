
        <!-- Theme Settings -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
            <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                <h5 class="text-white m-0">Theme Settings</h5>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body p-0">
                <div data-simplebar class="h-100">

        <div class="p-3">
            <!--div class="alert alert-warning" role="alert">
                <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
            </div-->


            <!-- Settings -->
            <h5 class="mt-3">Color Scheme</h5>
            <hr class="mt-1" />

            <div class="form-check form-switch mb-1">
                <input class="form-check-input self-form quite" data-name="color-scheme-mode"
                    data-action="{{ route('web.admin.account.settings.set') }}" type="checkbox" name="color-scheme-mode"
                    value="light" id="light-mode-check" {{ uconfig('color-scheme-mode') == 'light' ? 'checked' : '' }}>
                <label class="form-check-label" for="light-mode-check">Modo Claro</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input self-form quite" data-name="color-scheme-mode"
                    data-action="{{ route('web.admin.account.settings.set') }}" type="checkbox" name="color-scheme-mode"
                    type="checkbox" name="color-scheme-mode" value="dark" id="dark-mode-check"
                    {{ uconfig('color-scheme-mode') == 'dark' ? 'checked' : '' }}>
                <label class="form-check-label" for="dark-mode-check">Modo Nouturno</label>
            </div>



            <div class="d-grid mt-4">
                <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-cpanel-template/"
                    class="btn btn-primary mt-3" target="_blank"><i class="fa fa-play me-1"></i> Iniciar Tutorial</a>
            </div>
        </div> <!-- end padding-->

                </div>

            </div>
        </div>
