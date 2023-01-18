@extends('layouts.front-app')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb" style="background-image: url({{ asset('img/banner/common-banner.jpg')}})">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
			<div class="col-first">
				<h1>Shop Category</h1>
				<nav class="d-flex align-items-center">
					<a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
					<a href="{{ route('shop') }}">Shop<span class="lnr lnr-arrow-right"></span></a>
					<a href="#">{{ ucfirst($category_title) }} Category</a>
				</nav>
			</div>
		</div>
	</div>
</section>
<!-- End Banner Area -->
<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-md-5">
			<div class="sidebar-categories">
				<div class="head">Browse Categories</div>
				<ul class="main-categories">
					<li class="main-nav-list"><a href="{{ route('shop') }}"><span class="lnr lnr-arrow-right"></span>All Products<span class="number">({{ countProductByIdCategory(0) }})</span></a>
					</li>
					@foreach($categories as $category)
						<li class="main-nav-list"><a href="{{ route('shop_detail', $category->name) }}"><span class="lnr lnr-arrow-right"></span>{{ ucfirst($category->name) }}<span class="number">({{ countProductByIdCategory($category->id) }})</span></a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8 col-md-7">
			<!-- Start Filter Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<h3 class="text-white mt-3">Products</h3>
			</div>
			<!-- End Filter Bar -->
			<!-- Start Best Seller -->
			<section class="lattest-product-area pb-40 category-list">
				<div class="row">
					@foreach($products as $product)
					<!-- single product -->
					<div class="col-lg-4 col-md-6">
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
			</section>
			<!-- End Best Seller -->
		</div>
	</div>
</div>
@endsection


