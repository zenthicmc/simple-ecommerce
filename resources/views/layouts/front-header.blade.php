<!-- Start Header Area -->
<header class="header_area sticky-header">
   <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light main_box">
         <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="{{ route('home') }}"><h3 class="fw-bold">{{ env('APP_NAME') }}</h3></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
             aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
               <ul class="nav navbar-nav menu_nav ml-auto">
                  <li class="nav-item {{ $title == 'Home' ? 'active' : ''; }}"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                  <li class="nav-item {{ $title == 'Shop' ? 'active' : ''; }}"><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                  <li class="nav-item"><a class="nav-link" href="https://discord.gg/pbZ6AbntKA">Contact</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li class="nav-item">
                     <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
   </div>
   <div class="search_input" id="search_input_box">
      <div class="container">
         <form class="d-flex justify-content-between">
            <input type="text" class="form-control" id="search_input" placeholder="Search Here" autocomplete="off">
            <button type="submit" class="btn"></button>
            <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
         </form>
      </div>
   </div>
</header>
<!-- End Header Area -->