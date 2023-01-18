@extends('layouts.front-app')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb" style="background-image: url({{ asset('img/banner/common-banner.jpg')}})">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Checkout</h1>
                <nav class="d-flex align-items-center">
                    <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            @if ($message = Session::get('error'))
				<div class="col-md-12">
					<div class="alert bg-danger alert-dismissible fade show text-white" role="alert">
						{{ $message }}
					</div>
				</div>
			@endif
            <div class="row">
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2 class="text-center">Order Details</h2>
                        <ul class="list">
                            <li><a href="#">Product <span>Total</span></a></li>
                            <li><a href="#">{{ $product->name }} <span class="middle">x{{ $quantity }}</span> <span class="last">Rp. {{ number_format($product->price) }}</span></a></li>
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Subtotal <span>Rp. {{ number_format($quantity * $product->price) }}</span></a></li>
                            <li><a href="#">Biaya Admin <span>Rp 0</span></a></li>
                            <li><a href="#">Total <span>Rp. {{ number_format($quantity * $product->price) }}</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="order_box">
                        <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                            <h2 class="text-center">Choose Payment Method</h2>
                            <div class="d-flex justify-content-between" style="flex-wrap: wrap;
                            justify-content: center;">
                                @foreach($payment_channels as $method)
                                <div class="col-lg-4 mt-3 payment_item">
                                    <input type="radio" name="method" value="{{ $method->code }}" checked>
                                    <label>{{ substr($method->name, 0, 20) }}</label>
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="{{ $quantity }}">
                            <input type="hidden" name="amount" value="{{ $quantity * $product->price}}">
                            <input type="hidden" name="product_price" value="{{ $product->price }}">

                            <hr class="mt-4">
                            <button type="submit" class="primary-btn mt-4" style="width: 100%;border: none;" href="#">Proceed</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
@endsection