@extends('layouts.front-app')

@section('content')
<!-- start banner Area -->
<section class="banner-area">
	<div class="container">
		<div class="row fullscreen align-items-center justify-content-start">
			<div class="col-lg-12">
				<div class="active-banner-slider owl-carousel">
					<!-- single-slide -->
					<div class="row single-slide align-items-center d-flex">
						<div class="col-lg-6 col-md-6">
							<div class="banner-content">
								<h1>CrezzStore</h1>
								<p>is an online shop from Indonesia, we sell all your digital needs such as vps, rdp, accounts & many more</p>
								<div class="add-bag d-flex align-items-center">
									<a class="add-btn" href="{{ route('shop') }}"><span class="lnr lnr-cross"></span></a>
									<span class="add-text text-uppercase">Continue Shopping</span>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="banner-img">
								<img class="img-fluid mt-2" src="{{ asset('img/piddd2.png') }}" alt="">
							</div>
						</div>
					</div>
					<!-- single-slide -->
					<div class="row single-slide align-items-center d-flex">
						<div class="col-lg-6 col-md-6 mt-3">
							<div class="banner-content">
								<h1>CrezzStore</h1>
								<p>is an online shop from Indonesia, we sell all your digital needs such as vps, rdp, accounts & many more</p>
								<div class="add-bag d-flex align-items-center">
									<a class="add-btn" href="{{ route('shop') }}"><span class="lnr lnr-cross"></span></a>
									<span class="add-text text-uppercase">Continue Shopping</span>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="banner-img">
								<img class="img-fluid mt-2" src="{{ asset('img/piddd2.png') }}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- start features Area -->
<section class="features-area section_gap">
	<div class="container">
		<div class="row features-inner">
			<!-- single features -->
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-features">
					<div class="f-icon">
						<img src="{{ asset('karma/img/features/f-icon1.png') }}" alt="">
					</div>
					<h6>Free Delivery</h6>
					<p>Free Shipping on all order</p>
				</div>
			</div>
			<!-- single features -->
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-features">
					<div class="f-icon">
						<img src="{{ asset('karma/img/features/f-icon2.png') }}" alt="">
					</div>
					<h6>Return Policy</h6>
					<p>Free Shipping on all order</p>
				</div>
			</div>
			<!-- single features -->
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-features">
					<div class="f-icon">
						<img src="{{ asset('karma/img/features/f-icon3.png') }}" alt="">
					</div>
					<h6>24/7 Support</h6>
					<p>Free Shipping on all order</p>
				</div>
			</div>
			<!-- single features -->
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="single-features">
					<div class="f-icon">
						<img src="{{ asset('karma/img/features/f-icon4.png') }}" alt="">
					</div>
					<h6>Secure Payment</h6>
					<p>Free Shipping on all order</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end features Area -->


<!-- start product Area -->
<section class="owl-carousel active-product-area section_gap">
	<!-- single product slide -->
	<div class="single-product-slider">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Latest Products</h1>
						<p>Here you can see our latest product</p>
					</div>
				</div>
			</div>
			<div class="row m-2">
				@foreach($recent_products as $product)
				<!-- single product -->
				<div class="col-lg-3 col-md-6">
					<div class="single-product">
						<img class="img-fluid" src="{{ asset('product-images/' . $product->image) }}" alt="" style="max-height: 300px;">
						<div class="product-details">
							<h6>{{ $product->name }}</h6>
							<div class="price">
								<h6>Rp. {{ number_format($product->price) }}</h6>
							</div>
							<div class="prd-bottom">
								<a href="{{ route('product_detail', $product->slug) }}" class="social-info">
									<span class="lnr lnr-eye"></span>
									<p class="hover-text">view more</p>
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- single product slide -->
	<div class="single-product-slider">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>All Products</h1>
						<p>Here you can see our all product</p>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($all_products as $product)
				<!-- single product -->
				<div class="col-lg-3 col-md-6">
					<div class="single-product">
						<img class="img-fluid" src="{{ asset('product-images/' . $product->image) }}" alt="" style="max-height: 300px;">
						<div class="product-details">
							<h6>{{ $product->name }}</h6>
							<div class="price">
								<h6>Rp. {{ number_format($product->price) }}</h6>
							</div>
							<div class="prd-bottom">
								<a href="{{ route('product_detail', $product->slug) }}" class="social-info">
									<span class="lnr lnr-eye"></span>
									<p class="hover-text">view more</p>
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
<!-- end product Area -->

<!-- Start brand Area -->
<section class="brand-area section_gap">
	<div class="container">
		<div class="row">
			<a class="col single-img" href="#">
				<img class="img-fluid d-block mx-auto" src="{{ asset('karma/img/brand/1.png') }}" alt="">
			</a>
			<a class="col single-img" href="#">
				<img class="img-fluid d-block mx-auto" src="{{ asset('karma/img/brand/2.png') }}" alt="">
			</a>
			<a class="col single-img" href="#">
				<img class="img-fluid d-block mx-auto" src="{{ asset('karma/img/brand/3.png') }}" alt="">
			</a>
			<a class="col single-img" href="#">
				<img class="img-fluid d-block mx-auto" src="{{ asset('karma/img/brand/4.png') }}" alt="">
			</a>
			<a class="col single-img" href="#">
				<img class="img-fluid d-block mx-auto" src="{{ asset('karma/img/brand/5.png') }}" alt="">
			</a>
		</div>
	</div>
</section>
<!-- End brand Area -->
@endsection