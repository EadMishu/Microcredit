   <!-- Overlay-->
    <div id="overlay" class="overlay d-md-none"></div>
  <aside class="sidebar mt-2 position-fixed start-0 top-0 vh-100 d-flex flex-column" id="sidebar">
    <img src="{{asset('backend')}}/images/logo/lg-light.png" alt="Desktop Logo" class="d-md-none py-3 px-5">
    <!-- Start accordion wrapper -->
    <div class="flex-grow-1 overflow-y-auto">
      <ul class="nav flex-column gap-2 justify-content-center my-5" id="sidebarMenuAccordion">
    
        <!-- Dashboard menu -->
        <li class="nav-item mt-3">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#dashboard" aria-expanded="true">
            <i class="bi bi-house mx-1 fs-5"></i>
            <span class="ms-3">Dashboard</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse show fs-6 ms-3" id="dashboard" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="index.html">Sales</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="pages/dashboard/marketing.html">Marketing</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="pages/dashboard/app.html">App</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="pages/dashboard/analytics.html">Analytics</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="pages/dashboard/lms.html">LMS</a></li>
          </ul>
        </li>
    
        <!-- Apps menu -->
        <li class="nav-item">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#apps" aria-expanded="false">
            <i class="bi bi-terminal mx-1 fs-5"></i>
            <span class="ms-3">Collection</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse fs-6 ms-3" id="apps" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/about.html">All Information</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/about.html">Add New</a></li>
         
          </ul>
        </li>
      
        <!-- Pages menu start -->
        <li class="nav-item">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#pages" aria-expanded="true">
            <i class="bi bi-journals mx-1 fs-5"></i>
            <span class="ms-3">Pages</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse fs-6 ms-3" id="pages" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/about.html">About</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/blog.html">Blog</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/error.html">Error</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/gallery.html">Gallery</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/pricing.html">Pricing</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/profile.html">Profile</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/tables.html">Tables</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="/pages/terms.html">Terms</a></li>
          </ul>
        </li>
        <!-- Pages menu end -->
      
        <!-- Auth menu start -->
        <li class="nav-item">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#authentication" aria-expanded="true">
            <i class="bi bi-wallet2 mx-1 fs-5"></i>
            <span class="ms-3">Fixed Deposit</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse fs-6 ms-3" id="authentication" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('deposit.index')}}">All Information</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('deposit.create')}}">Add New</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('deposit-types.index')}}">Type</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('deposit_collections.index')}}">Collection</a></li>
            
          </ul>
        </li>
        <!-- Auth menu end -->
      
        <!-- Charts menu start -->
        <li class="nav-item">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#charts" aria-expanded="true">
            <i class="bi bi-cash-coin mx-1 fs-5"></i>
            <span class="ms-3">DPS</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse fs-6 ms-3" id="charts" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('dps.index')}}">All Information</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('dps.create')}}">Add New</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('dps-types.index')}}">Type</a>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('dps_collections.index')}}">Collection</a>
            </li>
            
          </ul>
        </li>
        <!-- Charts menu end -->
      
        <!-- E-commerce menu start -->
        <li class="nav-item">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#ecommerce" aria-expanded="true">
            <i class="bi bi-cash-stack mx-1 fs-5"></i>
            <span class="ms-3">Loan</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse fs-6 ms-3" id="ecommerce" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{ route('loans.index') }}">All information</a>
            </li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{ route('loans.create') }}">Add New</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{route('loan_collections.index')}}">Collection</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{ route('loan-types.index') }}">Type</a></li>
            
          </ul>
        </li>
        <!-- E-commerce menu end -->
      
        <!-- Elements menu start -->
        <li class="nav-item">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#elements" aria-expanded="true">
            <i class="bi bi-person-workspace mx-1 fs-5"></i>
            <span class="ms-3">Staff</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse fs-6 ms-3" id="elements" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{ route('admin.index') }}">All Staff</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{ route('admin.create') }}">Add new</a></li>
            
          </ul>
        </li>
        <!-- Elements menu end -->
      
        <!-- Forms menu start -->
        <li class="nav-item">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#forms" aria-expanded="true">
            <i class="bi bi-people mx-1 fs-5"></i>
            <span class="ms-3">Users</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse fs-6 ms-3" id="forms" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{ route('users.index') }}">All Users</a>
            </li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{ route('users.create') }}">Add new</a></li>
           
          </ul>
        </li>
        <!-- Forms menu end -->
      
        <!-- Icons menu start -->
        <li class="nav-item">
          <a class="nav-link d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#icons" aria-expanded="true">
            <i class="bi bi-diamond mx-1 fs-5"></i>
            <span class="ms-3">Icons</span>
            <i class="bi bi-arrow-right-short arrow ms-auto"></i>
          </a>
          <ul class="submenu collapse fs-6 ms-3" id="icons" data-bs-parent="#sidebarMenuAccordion">
            <li class="nav-item list-unstyled"><a class="nav-link" href="pages/icons/bootstrap.html">Bootstrap</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="pages/icons/fontawesome.html">Font Awesome</a></li>
            <li class="nav-item list-unstyled"><a class="nav-link" href="{{ route('test.index') }}">Test</a></li>
          </ul>
        </li>
        <!-- Icons menu end -->
        </ul>
    </div>
    
  </aside>