    
    
    
    
    <aside class="left-sidebar with-vertical">
      <!-- ---------------------------------- -->
      <!-- Start Vertical Layout Sidebar -->
      <!-- ---------------------------------- -->

      <div>
        <div class="brand-logo d-flex align-items-center">
          <a href="{{ url(dashboard) }}" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.svg" alt="Logo" class="dark-logo" />
            <img src="../assets/images/logos/light-logo.svg" alt="Logo" class="light-logo" />
          </a>
        </div>

        <!-- ---------------------------------- -->
        <!-- Dashboard -->
        <!-- ---------------------------------- -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul class="sidebar-menu" id="sidebarnav">
            <!-- User Profile-->
            <li>

            <!-- User Profile-->
            <!-- ---------------------------------- -->
            <!-- Home -->
            <!-- ---------------------------------- -->
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
              <span class="hide-menu">Personal</span>
            </li>
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('user.dashboard')}}" aria-expanded="false">
                <iconify-icon icon="solar:screencast-2-linear"></iconify-icon>
                <span class="hide-menu">Home</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('user.list')}}" aria-expanded="false">
                <iconify-icon icon="solar:atom-linear"></iconify-icon>
                <span class="hide-menu">User</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../main/index3.html" aria-expanded="false">
                <iconify-icon icon="solar:box-minimalistic-linear"></iconify-icon>
                <span class="hide-menu">Classy</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../main/index4.html" aria-expanded="false">
                <iconify-icon icon="solar:buildings-2-linear"></iconify-icon>
                <span class="hide-menu">Analytical</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../main/index5.html" aria-expanded="false">
                <iconify-icon icon="solar:basketball-linear"></iconify-icon>
                <span class="hide-menu">Minimal</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../main/index6.html" aria-expanded="false">
                <iconify-icon icon="solar:cart-large-2-linear"></iconify-icon>
                <span class="hide-menu">General</span>
              </a>
            </li>

           
           
         
               

            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <iconify-icon icon="solar:cardholder-line-duotone"></iconify-icon>
                <span class="hide-menu">Widgets</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../main/widgets-cards.html">
                    <span class="icon-small"></span>
                    <span class="hide-menu">Cards</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../main/widgets-banners.html">
                    <span class="icon-small"></span>
                    <span class="hide-menu">Banner</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../main/widgets-charts.html">
                    <span class="icon-small"></span>
                    <span class="hide-menu">Charts</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../main/widgets-feeds.html">
                    <span class="icon-small"></span>
                    <span class="hide-menu">Feeds</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../main/widgets-apps.html">
                    <span class="icon-small"></span>
                    <span class="hide-menu">Apps</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="../main/widgets-data.html">
                    <span class="icon-small"></span>
                    <span class="hide-menu">Data</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>

        <div class="sidebar-footer hide-menu">
          <!-- item-->
          <a href="../main/page-account-settings.html" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings"><iconify-icon icon="solar:settings-linear"></iconify-icon></a>
          <!-- item-->
          <a href="../main/app-email.html" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"><iconify-icon icon="solar:inbox-linear"></iconify-icon></a>
          <!-- item-->
          <a href="../main/authentication-login.html" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><iconify-icon icon="solar:power-bold"></iconify-icon></a>
        </div>
      </div>
    </aside>