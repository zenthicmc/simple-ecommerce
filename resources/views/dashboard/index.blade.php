@extends('layouts.dashboard-app')

@section('content')
  @if (Auth::user()->role == 'admin')
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Income</p>
                  <h5 class="font-weight-bolder mt-2 mb-2">
                    Rp. {{ number_format($total_income) }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Users</p>
                  <h5 class="font-weight-bolder mt-2 mb-2">
                    {{ $total_users }}
                  </h5>     
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                  <i class="fa-solid fa-user-group text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Products</p>
                  <h5 class="font-weight-bolder mt-2 mb-2">
                    {{ count($products) }}
                  </h5>       
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                  <i class="fa-solid fa-box-open text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">AVAILABLE STOCK</p>
                  <h5 class="font-weight-bolder mt-2 mb-2">
                    {{ count($stocks) }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                  <i class="fa-solid fa-cubes text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Recently Added Products</h6>
          </div>
          <div class="card-body p-3">
            <ul class="list-group">
              @foreach($recent_products as $product)
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="fa-solid fa-user text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">{{ ucwords($product->name) }}</h6>
                  </div>
                </div>
                <div class="d-flex">
                  <a class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto" href="{{ route('product_edit', $product->id) }}"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Recently Added Categories</h6>
          </div>
          <div class="card-body p-3">
            <ul class="list-group">
              @foreach($categories as $category)
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="ni ni-mobile-button text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">{{ ucwords($category->name) }}</h6>
                  </div>
                </div>
                <div class="d-flex">
                  <a class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto" href="{{ route('category_edit', $category->id) }}"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Pending Purchases</p>
                  <h5 class="font-weight-bolder mt-2 mb-3">
                    {{ $user_pending_transactions }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                  <i class="fa-solid fa-bag-shopping text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Success Purchases</p>
                  <h5 class="font-weight-bolder mt-2 mb-3">
                    {{ $user_paid_transactions }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-danger text-center rounded-circle">
                  <i class="fa-solid fa-bag-shopping text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Unpaid Invoices</p>
                  <h5 class="font-weight-bolder mt-2 mb-3">
                    {{ $user_unpaid_transactions }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                  <i class="fa-solid fa-credit-card text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Spend</p>
                  <h5 class="font-weight-bolder mt-2 mb-3">
                    Rp. {{ number_format($total_spend) }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                  <i class="fa-solid fa-money-bill text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
          <div class="card-header pb-0 pt-3 bg-transparent">
            @if(empty($announcement))
              <h5 class="text-capitalize text-center">No Announcement</h5>
            @else
              <h5 class="text-capitalize text-center">{{ $announcement->title }}</h5>
            @endif

            @if(!empty($announcement))
            <p class="text-sm mb-0">
              <i class="fa-solid fa-paper-plane text-success"></i>
              &nbsp;Posted by {{ $announcement->user->name }} ({{ date_format($announcement->created_at,"d-m-Y"); }})
            </p>
            @endif


          </div>
          <div class="card-body p-3">
            @if(empty($announcement))
              <p class="text-center">Announcement will be showed here</p>
            @else
              <p style="margin-left: 10px;">{{ $announcement->description }}</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection