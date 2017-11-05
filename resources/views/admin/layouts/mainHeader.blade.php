  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo hidden-xs">
      <span class="logo-mini"><b>Big</b></span>
      <span class="logo-lg"><b>Big</b>Pang</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-fixed-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      {{-- <div style="position: absolute;font-size: 1em;line-height: 50px;color: #fff;">互联网安全平台</div> --}}
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <span class="">{{auth('admin')->user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/123.png" class="img-circle" alt="User Image">
                <p>
                  {{auth('admin')->user()->username}} - 系统管理员
                  <small>最后登录:{{date('Y-m-d H:i',strtotime(auth('admin')->user()->updated_at))}}</small>
                </p>
              </li>

              </li>
              <!-- Menu Footer-->
              <li class="user-footer">

                <div class="pull-right">
                  <a href="/admin/logout" class="btn btn-default btn-flat">登出</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>