<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
   <div class="sidenav-header">
     <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
     <a class="navbar-brand m-0" href="/" target="_blank">
       {{-- <img src="{{ asset('argon/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo"> --}}
       <p class="ms-1 font-weight-bold text-center" style="font-size: 20px;">{{ env('APP_NAME') }}</p>
     </a>
   </div>
   <hr class="horizontal dark mt-0">
   <div class="collapse navbar-collapse w-auto" style="min-height: 80vh;" id="sidenav-collapse-main">
     <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ $title == 'Dashboard' ? 'active' : ''; }}" href="{{ route('dashboard') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Overview</span>
          </a>
        </li>
         <li class="nav-item">
           <a class="nav-link {{ $title == 'Admin | Users' ? 'active' : ''; }}" href="{{ route('users') }}">
             <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
               <i class="fa-solid fa-user-group text-dark text-sm opacity-10"></i>
             </div>
             <span class="nav-link-text ms-1">Users</span>
           </a>
         </li>
         <li class="nav-item">
          <a class="nav-link {{ $title == 'Admin | Invoices' ? 'active' : ''; }}" href="{{ route('admin.invoice') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Invoices</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $title == 'Admin | Purchases' ? 'active' : ''; }}" href="{{ route('admin.purchase') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-bag-shopping text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Purchases</span>
          </a>
        </li>
         <li class="nav-item">
           <a class="nav-link {{ $title == 'Admin | Categories' ? 'active' : ''; }}" href="{{ route('category') }}">
             <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
               <i class="fa-solid fa-list text-warning text-sm opacity-10"></i>
             </div>
             <span class="nav-link-text ms-1">Categories</span>
           </a>
         </li>
         <li class="nav-item">
           <a class="nav-link {{ $title == 'Admin | Products' ? 'active' : ''; }}" href="{{ route('product') }}">
             <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
               <i class="fa-solid fa-box-open text-info text-sm opacity-10"></i>
             </div>
             <span class="nav-link-text ms-1">Products</span>
           </a>
         </li>
         <li class="nav-item">
          <a class="nav-link {{ $title == 'Admin | Stocks' ? 'active' : ''; }}" href="{{ route('stock') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-cubes text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Stocks</span>
          </a>
         </li>
			<li class="nav-item">
          <a class="nav-link {{ $title == 'Admin | Reviews' ? 'active' : ''; }}" href="{{ route('review') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-star text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Reviews</span>
          </a>
         </li>
     </ul>
   </div>
</aside>