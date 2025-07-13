


<header class="d-flex justify-content-between align-items-center fixed-top z-index-10 container-fluide">
    <div class="d-flex align-items-center position-relative">
      <!-- Logo -->
      <div class="logo">
        <a href="index.html" class="d-flex justify-content-center">
          <img src="{{asset('backend')}}/images/logo/sm-light.png" alt="Mobile Logo" width="40px" class="mobile-logo d-none ms-2">
          <img src="{{asset('backend')}}/images/logo/lg-light.png" alt="Desktop Logo" class="desktop-logo px-5">
        </a>
      </div>

      <!-- Mobile menu toggle -->
      <button class="btn d-md-none" id="mobileMenuToggle">
        <i class="bi bi-list fs-1 text-muted"></i>
      </button>

      <!-- Desktop menu toggle -->
      <button class="btn d-none d-md-block" id="desktopToggleSidebar">
        <i class="bi bi-list fs-2 text-muted"></i>
      </button>

      <!-- Desktop search -->
      <div class="p-3 d-none d-lg-block">
        <div class="input-group border border-1 border-muted rounded input-field">
          <input type="text" class="form-control border-0 shadow-none py-2 input-field"
            placeholder="Search for results..." aria-label="Search">
          <span class="input-group-text border-0 bg-transparent py-2">
            <i class="bi bi-search text-muted"></i>
          </span>
        </div>
      </div>
    </div>

    <div>
      <ul class="d-flex align-items-center gap-4 mt-2">
        <!-- Mobile search icon -->
        <li class="dropdown d-lg-none list-unstyled">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
            aria-expanded="false">
            <i class="bi bi-search fs-5"></i>
          </a>
        </li>

        <!-- Language dropdown start -->
        <li class="dropdown list-unstyled">
          <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <img src="{{asset('backend')}}/images/flags/us.jpg" class="me-0 me-sm-1" height="12">
          </a>
          <div class="dropdown-menu dropdown-menu-end card-dark border shadow-sm">
            <a href="javascript:void(0);" class="dropdown-item">
              <img src="{{asset('backend')}}/images/flags/germany.jpg" alt="German flag" class="me-1" height="12">
              <span class="align-middle text-muted">German</span>
            </a>
            <a href="javascript:void(0);" class="dropdown-item">
              <img src="{{asset('backend')}}/images/flags/italy.jpg" alt="Italian flag" class="me-1" height="12">
              <span class="align-middle text-muted">Italian</span>
            </a>
            <a href="javascript:void(0);" class="dropdown-item">
              <img src="{{asset('backend')}}/images/flags/spain.jpg" alt="Spanish flag" class="me-1" height="12">
              <span class="align-middle text-muted">Spanish</span>
            </a>
            <a href="javascript:void(0);" class="dropdown-item">
              <img src="{{asset('backend')}}/images/flags/russia.jpg" alt="Russian flag" class="me-1" height="12">
              <span class="align-middle text-muted">Russian</span>
            </a>
          </div>
        </li>
        <!-- Language dropdown end -->

        <!-- Notification dropdown start -->
        <li class="dropdown list-unstyled">
          <a class="nav-link dropdown-toggle arrow-none position-relative" data-bs-toggle="dropdown" href="#"
            role="button" aria-haspopup="false" aria-expanded="false">
            <i class="bi bi-bell fs-5"></i>
            <span class="icon-badge">5</span>
          </a>

          <div class="dropdown-menu dropdown-menu-end p-3 dropdown-list border border-muted">
            <div class="d-flex justify-content-between">
              <h6 class="dropdown-header">Notifications</h6>
              <span class="badge text-primary">5 Unread</span>
            </div>

            <div class="list-group">
              <!-- Notification 1 -->
              <div class="border-bottom d-flex align-items-start gap-2 pb-2">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mt-2">
                  <i class="bi bi-person text-primary px-1"></i>
                </div>
                <div class="flex-grow-1">
                  <small><strong>Gladys Dare</strong> <a href="#"
                      class="text-primary text-decoration-none">commented</a> on Ecosystems</small>
                  <div class="text-muted small">2m ago</div>
                </div>
                <a href="#">
                  <i class="bi bi-x-lg cursor-pointer-bs text-muted"></i>
                </a>
              </div>

              <!-- Notification 2 -->
              <div class="border-bottom d-flex align-items-start gap-2 pb-2">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-success mt-2">
                  <i class="bi bi-check-circle px-1"></i>
                </div>
                <div class="flex-grow-1">
                  <small><strong>Laurel</strong> donated <span class="text-success">$100</span> for carbon
                    removal</small>
                  <div class="text-muted small">15 min ago</div>
                </div>
                <a href="#">
                  <i class="bi bi-x-lg cursor-pointer-bs text-muted"></i>
                </a>
              </div>

              <!-- Notification 3 -->
              <div class="border-bottom d-flex align-items-start gap-2 pb-2">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-success mt-2">
                  <i class="bi bi-hand-thumbs-up px-1"></i>
                </div>
                <div class="flex-grow-1">
                  <small><strong>Sunny Grahm</strong> voted for carbon capture</small>
                  <div class="text-muted small">2 min ago</div>
                </div>
                <a href="#">
                  <i class="bi bi-x-lg cursor-pointer-bs text-muted"></i>
                </a>
              </div>

              <!-- Notification 4 -->
              <div class="d-flex align-items-start gap-2">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-success mt-2">
                  <i class="bi bi-check-circle px-1"></i>
                </div>
                <div class="flex-grow-1">
                  <small><strong>Laurel</strong> donated <span class="text-success">$100</span> for carbon
                    removal</small>
                  <div class="text-muted small">15 min ago</div>
                </div>
                <a href="#">
                  <i class="bi bi-x-lg cursor-pointer-bs text-muted"></i>
                </a>
              </div>
            </div>
            <div class="mt-3">
              <button class="btn btn-primary btn-sm w-100">View All</button>
            </div>
          </div>
        </li>
        <!-- Notification dropdown end -->

        <!-- Message dropdown start -->
        <li class="dropdown list-unstyled">
          <a class="nav-link dropdown-toggle arrow-none position-relative text-decoration-none"
            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="bi bi-chat-left fs-5"></i>
            <span class="icon-badge">6</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end p-3 shadow-sm border rounded-3 message-dropdown card-dark">
            <small class="fw-semibold">6 New Messages</small>

            <!-- Message 1 -->
            <div class="d-flex align-items-start mt-2 mb-3">
              <img src="{{asset('backend')}}/images/avater/3.jpg" class="rounded-circle me-3" width="40" height="40" alt="avatar">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between">
                  <p class="mb-0 fw-semibold">Madeleine</p>
                  <small class="text-muted">2min ago</small>
                </div>
                <p class="mb-0 small">Just completed <a href="#" class="text-primary text-decoration-none">Project</a>
                </p>
              </div>
            </div>

            <!-- Message 2 -->
            <div class="d-flex align-items-start mb-3">
              <img src="{{asset('backend')}}/images/avater/4.jpg" class="rounded-circle me-3" width="40" height="40" alt="avatar">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between">
                  <p class="mb-0 fw-semibold">Olivia</p>
                  <small class="text-muted">1 hour ago</small>
                </div>
                <p class="mb-0 small">Added a file into <a href="#" class="text-primary text-decoration-none">Project
                    Name</a></p>
              </div>
            </div>

            <!-- Message 3 -->
            <div class="d-flex align-items-start mb-3">
              <img src="{{asset('backend')}}/images/avater/5.jpg" class="rounded-circle me-3" width="40" height="40" alt="avatar">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between">
                  <p class="mb-0 fw-semibold">Sanderson</p>
                  <small class="text-muted">1 days ago</small>
                </div>
                <p class="mb-0 small">Assigned 9 Upcoming <a href="#"
                    class="text-primary text-decoration-none">Projects</a></p>
              </div>
            </div>

            <!-- Message 4 -->
            <div class="d-flex align-items-start mb-2">
              <img src="{{asset('backend')}}/images/avater/3.jpg" class="rounded-circle me-3" width="40" height="40" alt="avatar">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between">
                  <p class="mb-0 fw-semibold">Madeleine</p>
                  <small class="text-muted">2min ago</small>
                </div>
                <p class="mb-0 small">Just completed <a href="#" class="text-primary text-decoration-none">Project</a>
                </p>
              </div>
            </div>

            <div class="mt-3">
              <button class="btn btn-primary btn-sm w-100 fw-semibold">View All</button>
            </div>
          </div>
        </li>
        <!-- Message dropdown end -->

        <!-- Settings icon -->
        <li class="d-none d-sm-inline-block list-unstyled">
          <a class="nav-link" data-bs-toggle="offcanvas" href="#">
            <i class="bi bi-gear fs-5"></i>
          </a>
        </li>

        <!-- Theme toggle -->
        <li class="d-none d-sm-inline-block list-unstyled">
          <a class="nav-link" href="#" id="toggle-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
            aria-label="Theme Mode" data-bs-original-title="Theme Mode">
            <i class="bi bi-moon fs-5"></i>
          </a>
        </li>

        <!-- Fullscreen toggle -->
        <li class="d-none d-md-inline-block list-unstyled">
          <a class="nav-link" href="#" data-toggle="fullscreen" id="fullscreenToggle">
            <i class="bi bi-fullscreen fs-5"></i>
          </a>
        </li>

        <!-- User dropdown start -->
        <li class="dropdown list-unstyled">
          <a class="d-flex gap-2 align-items-center nav-link dropdown-toggle pe-3" data-bs-toggle="dropdown" href="#"
            role="button" aria-haspopup="true" aria-expanded="false">
            <span class="account-user-avatar">
              <img src="{{asset('backend')}}/images/avater/2.jpg" alt="user-image" width="32" class="rounded-circle">
            </span>
            <div class="d-lg-flex flex-column gap-0 d-none">
              <p class="fw-semibold text-muted mb-0">Dominic</p>
              <small class="small text-muted mt-0">Administrator</small>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end card-dark border shadow-sm">
            <a href="#" class="dropdown-item d-flex align-items-center gap-2 text-muted">
              <i class="bi bi-person-circle me-1"></i>
              <span>Profile</span>
            </a>
            <a href="#" class="dropdown-item d-flex align-items-center justify-content-between py-2">
              <div class="d-flex align-items-center gap-2 text-muted">
                <i class="bi bi-envelope me-1"></i>
                <span>Inbox</span>
              </div>
              <span class="badge bg-success rounded-circle px-2">3</span>
            </a>
            <a href="#" class="dropdown-item d-flex align-items-center gap-2 text-muted">
              <i class="bi bi-sliders me-1"></i>
              <span>Settings</span>
            </a>
            <a href="#" class="dropdown-item d-flex align-items-center gap-2 text-muted">
              <i class="bi bi-headset me-1"></i>
              <span>Support</span>
            </a>
            <a href="#" class="dropdown-item d-flex align-items-center gap-2 text-muted">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-muted" style="background: none; border: none; width: 100%; text-align: left;">
                <i class="bi bi-box-arrow-right me-1"></i>
                <span>Log Out</span>
                </button>
            </form>
            </a>
          </div>
        </li>
        <!-- User dropdown end -->
      </ul>
    </div>
  </header>