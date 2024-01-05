      <!-- Sidebar menu-->
      <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
      <aside class="app-sidebar">
          <div class="app-sidebar__user"><img class="app-sidebar__user-avatar nf_picture"
                  src="{{ tools()->photo($user->photo) }}" alt="User Image">
              <div>
                  <p class="app-sidebar__user-name">{{ $user->names }}</p>
                  <p class="app-sidebar__user-designation">{{ $user->type }}</p>
              </div>
          </div>
          <ul class="app-menu">



              <!-- ----------- -->


              <li><a class="app-menu__item _link_" data-href="{{ route('web.admin.index') }}"
                      href="javascript:void()"><i class="app-menu__icon fa fa-chart-bar"></i><span
                          class="app-menu__label">Dashboard</span></a></li>
              <li class="treeview"><a class="app-menu__item" href="javascript:void()" data-toggle="treeview"><i
                          class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Usuarios</span><i
                          class="treeview-indicator fa fa-chevron-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a class="treeview-item _link_" data-href="{{ route('web.admin.user.index') }}"
                              href="javascript:void()" target="_blank" rel="noopener"><i class="icon fa fa-circle"></i>
                              Lista</a></li>
                      <li><a class="treeview-item _link_" data-href="{{ route('web.admin.user.add.index') }}"
                              href="javascript:void()"><i class="icon fa fa-circle"></i> Agregar</a></li>
                  </ul>
              </li>



              <!-- ----------- -->


              <li class="treeview"><a class="app-menu__item" href="javascript:void()" data-toggle="treeview"><i
                          class="app-menu__icon fa fa-newspaper"></i><span class="app-menu__label">Preguntas</span><i
                          class="treeview-indicator fa fa-chevron-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a class="treeview-item _link_" data-href="{{ route('web.admin.project.survey.add.index') }}"
                              href="javascript:void()"><i class="icon fa fa-circle"></i>Agregar</a></li>
                      <li><a class="treeview-item _link_" data-href="{{ route('web.admin.project.survey.index') }}"
                              href="javascript:void()"><i class="icon fa fa-circle"></i> Lista</a></li>
                      <hr class="my-1">
                      <li><a class="treeview-item _link_"
                              data-href="{{ route('web.admin.settings.survey_category.index') }}"
                              href="javascript:void()"><i class="icon fa fa-circle"></i>Respuestas</a></li>
                  </ul>
              </li>



              <!-- ----------- -->


              <li class="treeview"><a class="app-menu__item" href="javascript:void()" data-toggle="treeview"><i
                          class="app-menu__icon fa fa-globe"></i><span class="app-menu__label">Pagina</span><i
                          class="treeview-indicator fa fa-chevron-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a class="treeview-item _link_" data-href="{{ route('web.admin.page.page_info.index') }}"
                              href="javascript:void()"><i class="icon fa fa-circle"></i>Variaveis de Pagina</a></li>
                      <li><a class="treeview-item _link_" data-href="{{ route('web.admin.page.site_menu.index') }}"
                              href="javascript:void()"><i class="icon fa fa-circle"></i> Menus de Pagina</a></li>
                  </ul>
              </li>



              <!-- ----------- -->


              <li>
                <a class="app-menu__item _link_" data-href="{{ route('web.admin.settings.index') }}"
                    href="javascript:void()" target="_blank">
                    <i class="app-menu__icon fa fa-cog"></i>
                    <span class="app-menu__label">Configuracion</span>
                </a>
            </li>

            <!-- ----------- -->


            <li>
                <a class="app-menu__item _link_" data-href="{{ route('web.admin.developer.index') }}"
                    href="javascript:void()" target="_blank">
                    <i class="app-menu__icon fa fa-code"></i>
                    <span class="app-menu__label"> Desenvolvimento</span>
                </a>
            </li>


              <!-- ----------- -->


          </ul>
      </aside>
