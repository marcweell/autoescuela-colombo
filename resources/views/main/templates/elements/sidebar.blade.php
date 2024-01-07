      <!-- Sidebar menu-->
      <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
      <aside class="app-sidebar">
          <div class="app-sidebar__user"><img class="app-sidebar__user-avatar nf_picture"
                  src="{{ tools()->photo($user->photo) }}" alt="User Image">
              <div>
                  <p class="app-sidebar__user-name">{{ $user->name . ' ' . $user->last_name }}</p>
                  <p class="app-sidebar__user-designation">{{ $user->email }}</p>
              </div>
          </div>
          <ul class="app-menu">



              <li class="treeview"><a class="app-menu__item" href="javascript:void()" data-toggle="treeview"><i
                          class="app-menu__icon fa fa-newspaper"></i><span class="app-menu__label">Examen</span><i
                          class="treeview-indicator fa fa-chevron-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a class="treeview-item _link_" data-href="{{ route('web.app.survey.survey.index') }}"
                              href="javascript:void()"><i class="icon fa fa-circle"></i> Exámenes disponibles</a></li>
                      <hr class="my-1">
                      <li><a class="treeview-item _link_"
                              data-href="{{ route('web.app.survey.survey_answer.index') }}"
                              href="javascript:void()"><i class="icon fa fa-circle"></i>Mi Respuestas</a></li>
                  </ul>
              </li>



              <!-- ----------- -->


              <li>
                  <a class="app-menu__item _link_" data-href="{{ route('web.app.profile.index') }}"
                      href="javascript:void()" target="_blank">
                      <i class="app-menu__icon fa fa-cog"></i>
                      <span class="app-menu__label">Cuenta</span>
                  </a>
              </li>

              <!-- ----------- -->


              <li>
                  <a class="app-menu__item _link_ prompt" data-href="{{ route('web.account.auth.logout') }}"
                      href="javascript:void()" target="_blank">
                      <i class="app-menu__icon fa fa-door-open"></i>
                      <span class="app-menu__label"> Salir</span>
                  </a>
              </li>


              <!-- ----------- -->


          </ul>
      </aside>
