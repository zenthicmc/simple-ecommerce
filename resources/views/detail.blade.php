<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="">
	<!-- Meta Description -->
	<meta name="description" content="{{ $product->description }}">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>{{ env('APP_NAME') }} - {{ $product->name }}</title>
	<!--
			CSS
			============================================= -->
	<link rel="stylesheet" href="{{ asset('karma/css/linearicons.css') }}">
	<link rel="stylesheet" href="{{ asset('karma/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('karma/css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('karma/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('karma/css/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('karma/css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('karma/css/nouislider.min.css') }}">
	<link rel="stylesheet" href="{{ asset('karma/css/ion.rangeSlider.css') }}" />
	<link rel="stylesheet" href="{{ asset('karma/css/ion.rangeSlider.skinFlat.css') }}" />
	<link rel="stylesheet" href="{{ asset('karma/css/main.css') }}">
</head>

<body>

	@include('layouts.front-header')

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb" style="background-image: url({{ asset('img/banner/common-banner.jpg')}})">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Product Details</h1>
					<nav class="d-flex align-items-center">
						<a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="{{ route('shop') }}">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="{{ url()->full() }}">Product Details</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area" style="margin-bottom: 10%;">
		<div class="container">
			@if ($message = Session::get('error'))
				<div class="col-md-12">
					<div class="alert bg-danger alert-dismissible fade show text-white" role="alert">
						{{ $message }}
					</div>
				</div>
			@endif
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ asset('product-images/' . $product->image) }}" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ asset('product-images/' . $product->image) }}" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ asset('product-images/' . $product->image) }}" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ ucfirst($product->name) }}</h3>
						<h2>Rp. {{ number_format($product->price) }}</h2>
						@php 
							$stocks = countStockByIdProduct($product->id);
						@endphp
						<ul class="list">
							<li><a class="active" href="{{ route('shop_detail', $product->category->name) }}"><span>Category</span> : {{ ucfirst($product->category->name) }}</a></li>
							<li><a href="#"><span>Availibility</span> : {{ $stocks == 0 ? 'Out of' : $stocks }} Stocks</a></li>
							<li><a href="#"><span>Purchases</span> : {{ countPurchaseByIdProduct($product->id) }}</a></li>
						</ul>
						<hr>
						<div class="trix-content">{!! $product->description !!}</div>
						<hr>
						<form action="{{ route('checkout') }}" method="POST">
						@csrf
						<input type="hidden" name="slug" value="{{ $product->slug }}">
						<div class="product_count">
							<label for="qty">Quantity:</label>
							<input type="text" name="quantity" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
							 class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
							 class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>
						<div class="card_area d-flex align-items-center">
							@if ($stocks > 0)
								<button type="submit" class="primary-btn" style="border: none;">Purchase</button>
							@else
								<a class="genric-btn disable circle" href="{{ url()->full() }}">Out of Stock</a>
							@endif
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	@include('layouts.front-footer')

	<script src="{{ asset('karma/js/vendor/jquery-2.2.4.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="{{ asset('karma/js/vendor/bootstrap.min.js') }}"></script>
	<script src="{{ asset('karma/js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('karma/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('karma/js/jquery.sticky.js') }}"></script>
	<script src="{{ asset('karma/js/nouislider.min.js') }}"></script>
	<script src="{{ asset('karma/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('karma/js/owl.carousel.min.js') }}"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="{{ asset('karma/js/gmaps.min.js') }}"></script>
	<script src="{{ asset('karma/js/main.js') }}"></script>

</body>
</html>