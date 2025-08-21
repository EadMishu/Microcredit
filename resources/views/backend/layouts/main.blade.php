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
              <p class="mb-1 text-muted">Owner Balance</p>
              <h4 class="fw-bold mb-0 text-muted">{{ $ownerBalance }}</h4>
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
              <p class="mb-1 text-muted">Total Loan Balance</p>
              <h4 class="fw-bold mb-0 text-muted">{{ $loanBalance }}</h4>
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
              <p class="mb-1 text-muted">DPS Balance</p>
              <h4 class="fw-bold mb-0 text-muted">{{ $dpsBalance }}</h4>
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
              <p class="mb-1 text-muted">Deposit Balance</p>
              <h4 class="fw-bold mb-0 text-muted">{{ $depositBalance }}</h4>
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
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-dark border-0 shadow-sm p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-1 text-muted">Savings Balance</p>
              <h4 class="fw-bold mb-0 text-muted">{{ $savingsBalance }}</h4>
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
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-dark border-0 shadow-sm p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-1 text-muted">Deposit Balance</p>
              <h4 class="fw-bold mb-0 text-muted">{{ $depositBalance }}</h4>
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
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-dark border-0 shadow-sm p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-1 text-muted">Deposit Balance</p>
              <h4 class="fw-bold mb-0 text-muted">{{ $depositBalance }}</h4>
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
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-dark border-0 shadow-sm p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-1 text-muted">Deposit Balance</p>
              <h4 class="fw-bold mb-0 text-muted">{{ $depositBalance }}</h4>
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



  <!-- Chart 4 start -->

  <!-- Chart 4 end -->

  <!-- Charts row 2 end -->

  <!-- Data tables row start -->

  <!-- Data tables row end -->

  <!-- Bottom row start -->


  <!-- Products table start -->
  <div class="col-12 col-lg-12">
    <div class="card card-dark">
      <h5 class="p-3 border-bottom text-muted">Owners</h5>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-style mb-0 text-muted">
            <thead>
              <tr>
                <th class="text-muted">NAME</th>
                <th class="text-muted">CATEGORY</th>
                <th class="text-muted">Balance</th>
                <th class="text-muted">Division</th>
                <th class="text-muted">District</th>

                <th class="text-muted">STATUS</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($owners as $index => $owners)





              <tr>


                <td>{{ $owners->name }}</td>
                <td><span class="badge rounded-pill text-bg-primary">@if($owners->role == 4) owner @endif</span></td>
                <td>{{ $owners->balance }}</td>

                <td>{{ optional($owners->presentDivision)->name }}</td>

                <td>{{ optional($owners->presentDistrict)->name }}</td>



                @php
                $statusText = match($owners->status) {
                1 => 'Pending',
                2 => 'Running',
                3 => 'Closed',
                default => 'Unknown',
                };

                $statusClass = match($owners->status) {
                1 => 'bg-warning text-dark',
                2 => 'bg-success text-white',
                3 => 'bg-secondary text-white',
                default => 'bg-light text-dark',
                };
                @endphp

                <td>
                  <span class="badge {{ $statusClass }}">
                    {{ $statusText }}
                  </span>
                </td>

                </td>

              </tr>

              @endforeach
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

@push('js')
@include('backend.layouts.extension')
@endpush