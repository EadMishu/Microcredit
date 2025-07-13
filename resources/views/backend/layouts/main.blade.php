<main class="main-content px-3">
    <!-- Header start -->
     <div class="d-flex align-items-baseline justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3">
      <h3 class="pt-3 text-muted">Hello, Welcome To Dashboard</h3>
      <!-- Breadcrumb start -->
      <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sales</li>
        </ol>
      </nav>
      <!-- Breadcrumb end -->
     </div>
    
    <!-- Header end -->
  
    <!-- Cards start -->
    <div class="pt-2 px-0">
      <div class="row g-3">
        <!-- Card 1 start -->
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card card-dark border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="mb-1 text-muted">Product Sold</p>
                <h4 class="fw-bold mb-0 text-muted">57,865</h4>
              </div>
              <div class="icon-circle text-danger">
                <i class="bi bi-bag fs-5 fw-bold"></i>
              </div>
            </div>
            <small class="mt-2 d-block text-muted">
              <span class="text-success">
                2.6% <i class="bi bi-arrow-up"></i>
              </span>
              than last week
            </small>
          </div>
        </div>
        <!-- Card 1 end -->
  
        <!-- Card 2 start -->
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card card-dark border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="mb-1 text-muted">Total Balance</p>
                <h4 class="fw-bold mb-0 text-muted">$2,156</h4>
              </div>
              <div class="icon-circle bg-opacity-25 text-success">
                <i class="bi bi-wallet2 fs-5 fw-bold"></i>
              </div>
            </div>
            <small class="mt-2 d-block text-muted">
              <span class="text-danger">0.06% <i class="bi bi-arrow-down"></i></span>
              than last week
            </small>
          </div>
        </div>
        <!-- Card 2 end -->
  
        <!-- Card 3 start -->
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card card-dark border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="mb-1 text-muted">Sales & Profit</p>
                <h4 class="fw-bold mb-0 text-muted">$12,105</h4>
              </div>
              <div class="icon-circle bg-opacity-25 text-primary">
                <i class="bi bi-cash-coin fs-5 fw-bold"></i>
              </div>
            </div>
            <small class="mt-2 d-block text-muted">
              <span class="text-danger">0.15% <i class="bi bi-arrow-down"></i></span>
              than last week
            </small>
          </div>
        </div>
        <!-- Card 3 end -->
  
        <!-- Card 4 start -->
        <div class="col-12 col-md-6 col-lg-3">
          <div class="card card-dark border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="mb-1 text-muted">Total Expenses</p>
                <h4 class="fw-bold mb-0 text-muted">$4,673</h4>
              </div>
              <div class="icon-circle bg-opacity-25 text-warning">
                <i class="bi bi-credit-card fs-5 fw-bold"></i>
              </div>
            </div>
            <small class="mt-2 d-block text-muted">
              <span class="text-success">1.05% <i class="bi bi-arrow-up"></i></span>
              than last week
            </small>
          </div>
        </div>
        <!-- Card 4 end -->
      </div>
    </div>
    <!-- Cards end -->
  
    <!-- Charts row 1 start -->
    <div class="row g-3 mt-1">
      <!-- Chart 1 start -->
      <div class="col-12 col-md-5 col-xl-4 col-xxl-3">
        <div class="card card-dark h-100">
          <div class="card-body">
            <h5 class="text-muted">Sales By Category</h5>
            <div id="sales-by-category"></div>
          </div>
        </div>
      </div>
      <!-- Chart 1 end -->
  
      <!-- Chart 2 start -->
      <div class="col-12 col-md-7 col-xl-8 col-xxl-9">
        <div class="card card-dark h-100">
          <div class="card-body">
            <h5 class="text-muted">Monthly Sales Statistics</h5>
            <div id="monthly-sales-statistics"></div>
          </div>
        </div>
      </div>
      <!-- Chart 2 end -->
    </div>
    <!-- Charts row 1 end -->
  
    <!-- Charts row 2 start -->
    <div class="row g-3 mt-1">
      <!-- Chart 3 start -->
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card card-dark h-100">
          <div class="card-body">
            <h5 class="text-muted">Order Status</h5>
            <div id="order-status"></div>
          </div>
        </div>
      </div>
      <!-- Chart 3 end -->
  
      <!-- Chart 4 start -->
      <div class="col-12 col-md-6 col-lg-8">
        <div class="card card-dark h-100">
          <div class="card-body">
            <h5 class="text-muted">Monthly Sales</h5>
            <div id="monthly-sales"></div>
          </div>
        </div>
      </div>
      <!-- Chart 4 end -->
    </div>
    <!-- Charts row 2 end -->
  
    <!-- Data tables row start -->
    <div class="row g-3 mt-1">
      <!-- Analytics table start -->
      <div class="col-lg-8">
        <div class="card card-dark">
          <div class="card-body">
            <h5 class="table-title text-muted">Google Analytics Traffic Channels & Goals</h5>
            <table class="table table-hover table-bordered table-style text-muted">
              <thead>
                <tr>
                  <th>CHANNEL & GOALS</th>
                  <th>SESSIONS</th>
                  <th>BOUNCE RATE</th>
                  <th>TRAFFIC</th>
                  <th>CHANGE</th>
                </tr>
              </thead>
              <tbody>
                <!-- Row 1 start -->
                <tr>
                  <td>Organic Search</td>
                  <td>123,879</td>
                  <td>45.9%</td>
                  <td>7.5%</td>
                  <td class="text-success"><i class="bi bi-arrow-up"></i> 56%</td>
                </tr>
                <!-- Row 1 end -->
  
                <!-- Row 2 start -->
                <tr>
                  <td>Direct</td>
                  <td>45,789</td>
                  <td>32.1%</td>
                  <td>3.5%</td>
                  <td class="text-success"><i class="bi bi-arrow-up"></i> 12%</td>
                </tr>
                <!-- Row 2 end -->
  
                <!-- Row 3 start -->
                <tr>
                  <td>Email</td>
                  <td>67,892</td>
                  <td>26.3%</td>
                  <td>8.1%</td>
                  <td class="text-danger"><i class="bi bi-arrow-down"></i> 33%</td>
                </tr>
                <!-- Row 3 end -->
  
                <!-- Row 4 start -->
                <tr>
                  <td>Paid Search</td>
                  <td>628,567</td>
                  <td>9.3%</td>
                  <td>6.0%</td>
                  <td class="text-success"><i class="bi bi-arrow-up"></i> 45%</td>
                </tr>
                <!-- Row 4 end -->
  
                <!-- Row 5 start -->
                <tr>
                  <td>Referral</td>
                  <td>123,879</td>
                  <td>78.6%</td>
                  <td>6.8%</td>
                  <td class="text-danger"><i class="bi bi-arrow-down"></i> 76%</td>
                </tr>
                <!-- Row 5 end -->
  
                <!-- Row 6 start -->
                <tr>
                  <td>Call In</td>
                  <td>89,298</td>
                  <td>49.2%</td>
                  <td>1.5%</td>
                  <td class="text-success"><i class="bi bi-arrow-up"></i> 29%</td>
                </tr>
                <!-- Row 6 end -->
  
                <!-- Row 7 start -->
                <tr>
                  <td>Contact Us</td>
                  <td>397,268</td>
                  <td>85.4%</td>
                  <td>8.3%</td>
                  <td class="text-danger"><i class="bi bi-arrow-down"></i> 12%</td>
                </tr>
                <!-- Row 7 end -->
  
                <!-- Row 8 start -->
                <tr>
                  <td>Proposal</td>
                  <td>924,179</td>
                  <td>48.2%</td>
                  <td>4.2%</td>
                  <td class="text-success"><i class="bi bi-arrow-up"></i> 56%</td>
                </tr>
                <!-- Row 8 end -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Analytics table end -->
  
      <!-- Activity feed start -->
      <div class="col-lg-4">
        <div class="card card-dark shadow-sm">
          <div class="card-body pb-0">
            <h5 class="fw-bold mb-3 text-muted">Recent Activity</h5>
            <ul class="list-unstyled">
  
              <!-- Activity 1 start -->
              <li class="d-flex align-items-start mb-4">
                <img src="https://i.pravatar.cc/40?img=1" class="rounded-circle me-3" width="40" height="40" alt="User">
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h6 class="mb-0 fw-semibold">Successful Purchase</h6>
                      <small class="text-muted">Order ID: #4567</small>
                    </div>
                    <small class="text-primary fw-semibold">29 Mar 2020</small>
                  </div>
                </div>
              </li>
              <!-- Activity 1 end -->
  
              <!-- Activity 2 start -->
              <li class="d-flex align-items-start mb-4">
                <img src="https://i.pravatar.cc/40?img=2" class="rounded-circle me-3" width="40" height="40" alt="User">
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h6 class="mb-0 fw-semibold">New Registered Seller</h6>
                      <small class="text-muted">User ID: #8976</small>
                    </div>
                    <small class="text-primary fw-semibold">25 Mar 2020</small>
                  </div>
                </div>
              </li>
              <!-- Activity 2 end -->
  
              <!-- Activity 3 start -->
              <li class="d-flex align-items-start mb-4">
                <img src="https://i.pravatar.cc/40?img=2" class="rounded-circle me-3" width="40" height="40" alt="User">
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h6 class="mb-0 fw-semibold">Order Verification</h6>
                      <small class="text-muted">Order ID: #6290</small>
                    </div>
                    <small class="text-primary fw-semibold">14 Feb 2020</small>
                  </div>
                </div>
              </li>
              <!-- Activity 3 end -->
  
              <!-- Activity 4 start -->
              <li class="d-flex align-items-start mb-4">
                <img src="https://i.pravatar.cc/40?img=3" class="rounded-circle me-3" width="40" height="40" alt="User">
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h6 class="mb-0 fw-semibold">New Item Added</h6>
                      <small class="text-muted">Item ID: #0235</small>
                    </div>
                    <small class="text-primary fw-semibold">02 Feb 2020</small>
                  </div>
                </div>
              </li>
              <!-- Activity 4 end -->
  
              <!-- Activity 5 start -->
              <li class="d-flex align-items-start mb-4">
                <img src="https://i.pravatar.cc/40?img=4" class="rounded-circle me-3" width="40" height="40" alt="User">
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h6 class="mb-0 fw-semibold">Purchase Cancellation</h6>
                      <small class="text-muted">Order ID: #1905</small>
                    </div>
                    <small class="text-primary fw-semibold">28 Jan 2020</small>
                  </div>
                </div>
              </li>
              <!-- Activity 5 end -->
  
              <!-- Activity 6 start -->
              <li class="d-flex align-items-start">
                <img src="https://i.pravatar.cc/40?img=5" class="rounded-circle me-3" width="40" height="40"
                  alt="User  User">
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h6 class="mb-0 fw-semibold">Purchase Cancellation</h6>
                      <small class="text-muted">Order ID: #1005</small>
                    </div>
                    <small class="text-primary fw-semibold">28 Jan 2020</small>
                  </div>
                </div>
              </li>
              <!-- Activity 6 end -->
            </ul>
          </div>
        </div>
      </div>
      <!-- Activity feed end -->
    </div>
    <!-- Data tables row end -->
  
    <!-- Bottom row start -->
    <div class="row g-3 mt-1 mb-3">
      <!-- Customers list start -->
      <div class="col-12 col-lg-4">
        <div class="card card-dark">
          <h5 class="text-muted p-3 border-bottom">New Customers</h5>
          <ul class="card card-dark moet-body p-0">
  
            <!-- Customer 1 start -->
            <li class="customer-card d-flex align-items-center px-3 py-2 border-bottom">
              <img src="{{asset('backend')}}/images/avater/1.jpg" alt="Mozelle Belt"
                class="avatar rounded-circle object-fit-cover me-3">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Mozelle Belt</h6>
                  <span class="badge badge-custom bg-success">+ $246</span>
                </div>
                <small class="text-muted">Web Designer</small>
              </div>
            </li>
            <!-- Customer 1 end -->
  
            <!-- Customer 2 start -->
            <li class="customer-card d-flex align-items-center px-3 py-2 border-bottom">
              <img src="{{asset('backend')}}/images/avater/6.jpg" alt="Thomos" class="avatar rounded-circle object-fit-cover me-3">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Thomos</h6>
                  <span class="badge badge-custom bg-danger">- $58</span>
                </div>
                <small class="text-muted">Web Designer</small>
              </div>
            </li>
            <!-- Customer 2 end -->
  
            <!-- Customer 3 start -->
            <li class="customer-card d-flex align-items-center px-3 py-2 border-bottom">
              <img src="{{asset('backend')}}/images/avater/3.jpg" alt="Harry Dyer" class="avatar rounded-circle object-fit-cover me-3">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Harry Dyer</h6>
                  <span class="badge badge-custom bg-success">+ $59</span>
                </div>
                <small class="text-muted">Administrator</small>
              </div>
            </li>
            <!-- Customer 3 end -->
  
            <!-- Customer 4 start -->
            <li class="customer-card d-flex align-items-center px-3 py-2 border-bottom">
              <img src="{{asset('backend')}}/images/avater/4.jpg" alt="Anney Clair" class="avatar rounded-circle object-fit-cover me-3">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Anney Clair</h6>
                  <span class="badge badge-custom bg-success">+ $124</span>
                </div>
                <small class="text-muted">Administrator</small>
              </div>
            </li>
            <!-- Customer 4 end -->
  
            <!-- Customer 5 start -->
            <li class="customer-card d-flex align-items-center px-3 py-2 border-bottom">
              <img src="{{asset('backend')}}/images/avater/5.jpg" alt="Steven Fraser"
                class="avatar rounded-circle object-fit-cover me-3">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Steven Fraser</h6>
                  <span class="badge badge-custom bg-danger">- $168</span>
                </div>
                <small class="text-muted">Manager</small>
              </div>
            </li>
            <!-- Customer 5 end -->
  
            <!-- Customer 6 start -->
            <li class="customer-card d-flex align-items-center px-3 py-2 border-bottom">
              <img src="{{asset('backend')}}/images/avater/1.jpg" alt="Steven Fraser"
                class="avatar rounded-circle object-fit-cover me-3">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Steven Fraser</h6>
                  <span class="badge badge-custom bg-danger">- $168</span>
                </div>
                <small class="text-muted">Manager</small>
              </div>
            </li>
            <!-- Customer 6 end -->
  
            <!-- Customer 7 start -->
            <li class="customer-card d-flex align-items-center px-3 py-2">
              <img src="{{asset('backend')}}/images/avater/6.jpg" alt="Nicola Parsons"
                class="avatar rounded-circle object-fit-cover me-3">
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Nicola Parsons</h6>
                  <span class="badge badge-custom bg-success">+ $86</span>
                </div>
                <small class="text-muted">Web Developer</small>
              </div>
            </li>
            <!-- Customer 7 end -->
          </ul>
        </div>
      </div>
      <!-- Customers list end -->
  
      <!-- Products table start -->
      <div class="col-12 col-lg-8">
        <div class="card card-dark">
          <h5 class="p-3 border-bottom text-muted">Top Selling Products</h5>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-style mb-0 text-muted">
                <thead>
                  <tr>
                    <th class="text-muted">PRODUCT NAME</th>
                    <th class="text-muted">CATEGORY</th>
                    <th class="text-muted">PRICE</th>
                    <th class="text-muted">SOLD</th>
                    <th class="text-muted">STATUS</th>
                    <th class="text-muted">ACTION</th>
                  </tr>
                </thead>
                <tbody>
  
                  <!-- Product 1 start -->
                  <tr class="mb-0">
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{asset('backend')}}/images/products/1.jpg" alt="Chair" class="product-img me-3">
                        <div>
                          <p class="product-title">Chair</p>
                          <p class="product-subtitle">wooden chair</p>
                        </div>
                    </td>
                    <td>Home Accessories</td>
                    <td>$59.00</td>
                    <td>261</td>
                    <td><span class="fs-6">Out of stock</span></td>
                    <td>
                      <div class="d-flex">
                        <i class="bi bi-heart fs-6 me-2 icon"></i>
                        <i class="bi bi-trash text-danger fs-6 icon"></i>
                      </div>
                    </td>
                  </tr>
                  <!-- Product 1 end -->
  
                  <!-- Product 2 start -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{asset('backend')}}/images/products/2.jpg" alt="Small Pot" class="product-img me-3">
                        <div>
                          <p class="product-title">Small Pot</p>
                          <p class="product-subtitle">Pot</p>
                        </div>
                      </div>
                    </td>
                    <td>Home decorators</td>
                    <td>$45.00</td>
                    <td>149</td>
                    <td><span class="fs-6">In Stock</span></td>
                    <td>
                      <div class="d-flex">
                        <i class="bi bi-heart fs-6 me-2 icon"></i>
                        <i class="bi bi-trash text-danger fs-6 icon"></i>
                      </div>
                    </td>
                  </tr>
                  <!-- Product 2 end -->
  
                  <!-- Product 3 start -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{asset('backend')}}/images/products/3.jpg" alt="T-Shirt" class="product-img me-3">
                        <div>
                          <p class="product-title">T-Shirt</p>
                          <p class="product-subtitle">Half Sleeves</p>
                        </div>
                      </div>
                    </td>
                    <td>Men Wear</td>
                    <td>$123.00</td>
                    <td>138</td>
                    <td><span class="fs-6">In Stock</span></td>
                    <td>
                      <div class="d-flex">
                        <i class="bi bi-heart fs-6 me-2 icon"></i>
                        <i class="bi bi-trash text-danger fs-6 icon"></i>
                      </div>
                    </td>
                  </tr>
                  <!-- Product 3 end -->
  
                  <!-- Product 4 start -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{asset('backend')}}/images/products/4.jpg" alt="Shoes" class="product-img me-3">
                        <div>
                          <p class="product-title">Shoes</p>
                          <p class="product-subtitle">Causal Shoe</p>
                        </div>
                      </div>
                    </td>
                    <td>Foot Wear</td>
                    <td>$123.00</td>
                    <td>123</td>
                    <td><span class="fs-6">In Stock</span></td>
                    <td>
                      <div class="d-flex">
                        <i class="bi bi-heart fs-6 me-2 icon"></i>
                        <i class="bi bi-trash text-danger fs-6 icon"></i>
                      </div>
                    </td>
                  </tr>
                  <!-- Product 4 end -->
  
                  <!-- Product 5 start -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{asset('backend')}}/images/products/5.jpg" alt="Erar Buds" class="product-img me-3">
                        <div>
                          <p class="product-title">Erar Buds</p>
                          <p class="product-subtitle">Erar Buds</p>
                        </div>
                      </div>
                    </td>
                    <td>Foot Wear</td>
                    <td>$123.00</td>
                    <td>123</td>
                    <td><span class="fs-6">In Stock</span></td>
                    <td>
                      <div class="d-flex">
                        <i class="bi bi-heart fs-6 me-2 icon"></i>
                        <i class="bi bi-trash text-danger fs-6 icon"></i>
                      </div>
                    </td>
                  </tr>
                  <!-- Product 5 end -->
  
                  <!-- Product 6 start -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{asset('backend')}}/images/products/6.jpg" alt="Mobile" class="product-img me-3">
                        <div>
                          <p class="product-title">Mobile</p>
                          <p class="product-subtitle">smart phone</p>
                        </div>
                      </div>
                    </td>
                    <td>Electronic gadgets</td>
                    <td>$98.00</td>
                    <td>37</td>
                    <td><span class="fs-6">Out of Stock</span></td>
                    <td>
                      <div class="d-flex">
                        <i class="bi bi-heart fs-6 me-2 icon"></i>
                        <i class="bi bi-trash text-danger fs-6 icon"></i>
                      </div>
                    </td>
                  </tr>
                  <!-- Product 6 end -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Products table end -->
    </div>
    <!-- Bottom row end -->
  </main>