<header class="main-header">
    <!-- Logo -->
    <a href="{{ BeUrl() }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Y</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b> YP</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-align: center;padding: 5px;">
              {{ session::get('ses_username') }}
              <spa style="display: block;font-size: 10px;margin: 0;padding: 0;">[{{ strtoupper(val(session::get('ses_switch_to'), session::get('ses_switch_active'))['nama']) }}]</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header text-center">{{ trans('global.switch_profile') }}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                @if(!empty(session::get('ses_switch_to')))
                <ul class="menu">
                  @foreach( session::get('ses_switch_to') as $sId=>$sValue )
                  <li>
                    <a href="{{ BeUrl('switch-profile/'.$sId) }}">
                      <i class="fa fa-circle {{ session::get('ses_switch_active')==$sId ? 'text-success' : '' }}"></i> <span style="font-weight: {{ session::get('ses_switch_active')==$sId ? 'bold' : 'normal' }}">{{ strtoupper($sValue['nama']) }}</span>
                    </a>
                  </li>
                  @endforeach
                </ul>
                @endif
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
</header>