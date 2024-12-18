
 <style>
.farmlogo{
    width: 80%;
}
 </style>
    <aside class="left-sidebar with-vertical">
      <div>
        <div class="brand-logo d-flex align-items-center">
          <a href="{{ route('user.dashboard') }}" class="text-nowrap logo-img">
            <img src="{{asset('/assets/images/logos/farm_logo.jpeg')}}" alt="Logo" class="dark-logo farmlogo" />
            <img src="{{asset('/assets/images/logos/farm_logo.jpeg')}}" alt="Logo" class="light-logo farmlogo" />
          </a>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul class="sidebar-menu" id="sidebarnav">

            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            
            @if (auth()->check())
              @if(auth()->user()->role == 1 || auth()->user()->role == 4 || auth()->user()->role == 7)  

                <li class="sidebar-item">
                  <a class="sidebar-link {{ Request::routeIs('user.dashboard') ? 'active' : '' }}"  href="{{route('user.dashboard')}}" aria-expanded="false">
                    <iconify-icon icon="solar:home-linear"></iconify-icon>
                    <span class="hide-menu">Home</span>
                  </a>
                </li>
              @endif
              @if(auth()->user()->role == 1 || auth()->user()->role == 2 || auth()->user()->role == 7)
                <li class="sidebar-item">
                  <a class="sidebar-link {{ Request::routeIs('user.list') ? 'active' : '' }}" href="{{route('user.list')}}" aria-expanded="false">
                    <iconify-icon icon="solar:user-linear"></iconify-icon>
                    <span class="hide-menu">
                      @if(auth()->user()->role == 2)
                          Crews
                      @else
                          Users
                      @endif
                    </span>
                  </a>
                </li>
              @endif
              @if(auth()->user()->role == 2 || auth()->user()->role == 1 || auth()->user()->role == 7)
                <li class="sidebar-item">
                  <a class="sidebar-link {{ Request::routeIs('lobor.entry') ? 'active' : '' }}" href="{{ route('lobor.entry') }}" aria-expanded="false">
                    <iconify-icon icon="solar:clipboard-list-line-duotone"></iconify-icon>
                    <span class="hide-menu">Labor Entry</span>
                  </a>
                </li>
              @endif
              @if(auth()->user()->role == 1 || auth()->user()->role == 7)
                <li class="sidebar-item">
                  <a class="sidebar-link {{ Request::routeIs('invoice.entry') ? 'active' : '' }}" href="{{ route('invoice.entry') }}" aria-expanded="false">
                    <iconify-icon icon="solar:clipboard-list-line-duotone"></iconify-icon>
                    <span class="hide-menu">Invoice Entry</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link {{ Request::routeIs('labor.allocate') ? 'active' : '' }}" href="{{ route('labor.allocate') }}" aria-expanded="false">
                    <iconify-icon icon="clarity:assign-user-line"></iconify-icon>
                    <span class="hide-menu">Labor Allocate</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link {{ Request::routeIs('todo.list') ? 'active' : '' }}" href="{{ route('todo.list') }}" aria-expanded="false">
                    <iconify-icon icon="arcticons:pomotodo"></iconify-icon>
                    <span class="hide-menu">To Do</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link {{ Request::routeIs('expense.list') ? 'active' : '' }}" href="{{ route('expense.list') }}" aria-expanded="false">
                    <iconify-icon icon="arcticons:pomotodo"></iconify-icon>
                    <span class="hide-menu">Expense</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link {{ Request::routeIs('data.base') ? 'active' : '' }}" href="{{ route('data.base') }}" aria-expanded="false">
                    <iconify-icon icon="clarity:assign-user-line"></iconify-icon>
                    <span class="hide-menu">Data Base</span>
                  </a>
                </li>
              @endif
              @if(auth()->user()->role == 1)
                <li class="sidebar-item">
                  <a class="sidebar-link has-arrow {{ Request::is('setup/*') ? 'active' : '' }}" href="#" aria-expanded="{{ Request::is('setup/*') ? 'true' : 'false' }}">
                    <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                    <span class="hide-menu">Setup</span>
                </a>
                  <ul aria-expanded="{{ Request::is('setup/*') ? 'true' : 'false' }}" class="collapse first-level {{ Request::is('setup/*') ? 'show' : '' }}">
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::routeIs('setup.page') ? 'active' : '' }}" href="{{route('setup.page')}}" aria-expanded="false">
                        <iconify-icon icon="carbon:user-role"></iconify-icon>
                        <span class="hide-menu">Client Setup</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::routeIs('crew.setup') ? 'active' : '' }}" href="{{route('crew.setup')}}" aria-expanded="false">
                        <iconify-icon icon="carbon:user-role"></iconify-icon>
                        <span class="hide-menu">Crew Setup</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::routeIs('user.role') ? 'active' : '' }}" href="{{route('user.role')}}" aria-expanded="false">
                        <iconify-icon icon="carbon:user-role"></iconify-icon>
                        <span class="hide-menu">Role</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::is('jobsubcategory') ? 'active' : '' }}" href="{{ route('jobsubcategory') }}" aria-expanded="false">
                        <iconify-icon icon="carbon:user-role"></iconify-icon>
                        <span class="hide-menu">Job SubCategory</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::is('jobdescription') ? 'active' : '' }}" href="{{ url('jobdescription') }}" aria-expanded="false">
                        <iconify-icon icon="carbon:user-role"></iconify-icon>
                        <span class="hide-menu">Labor Job</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::is('nonjob.list') ? 'active' : '' }}" href="{{ route('nonjob.list') }}" aria-expanded="false">
                        <span class="icon-small"></span>
                        <iconify-icon icon="hugeicons:configuration-02"></iconify-icon>
                        <span class="hide-menu">Non Labor Job</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::routeIs('ranch.list') ? 'active' : '' }}" href="{{route('ranch.list')}}">
                        <span class="icon-small"></span>
                        <iconify-icon icon="lucide:land-plot"></iconify-icon>
                        <span class="hide-menu">Ranch</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::routeIs('block.list') ? 'active' : '' }}" href="{{route('block.list')}}">
                      <iconify-icon icon="arcticons:falling-blocks"></iconify-icon>
                        <span class="hide-menu">Block</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::routeIs('acre.list') ? 'active' : '' }}" href="{{route('acre.list')}}">
                      <iconify-icon icon="mdi:selection-location"></iconify-icon>
                        <span class="hide-menu">Acre</span>
                      </a>
                    </li>
                  </ul>
                </li>
              @endif
            @endif
          </ul>
        </nav>

        <div class="sidebar-footer hide-menu">
          <!-- item-->
          <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings"><iconify-icon icon="solar:settings-linear"></iconify-icon></a>
          <!-- item-->
          <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"><iconify-icon icon="solar:inbox-linear"></iconify-icon></a>
          <!-- item-->
          <a href="{{ route('logout') }}" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><iconify-icon icon="solar:power-bold"></iconify-icon></a>
        </div>
      </div>
    </aside>