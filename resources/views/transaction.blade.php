@extends('layouts.front-app')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb" style="background-image: url({{ asset('img/banner/common-banner.jpg')}})">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Confirmation</h1>
                <nav class="d-flex align-items-center">
                    <a href="#">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Confirmation</a>
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
            <h2 id="show-message" class="text-success text-center mb-5" style="visibility: hidden;position:relative;">Thank you. Your order has been received, please refresh this page</h2>
            <div class="row">
               <div class="col-lg-5">
                    <div class="order_box">
                     <h2 class="text-center">Order Details</h2>
                     @foreach($detail->order_items as $item)
                        <ul class="list">
                            <li><a href="#">Product <span>Total</span></a></li>
                            <li><a href="#">{{ $item->name }} <span class="middle">x{{ $item->quantity }}</span> <span class="last">Rp. {{ number_format($item->price) }}</span></a></li>
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Biaya Admin <span>Rp 0</span></a></li>
                            <li><a href="#">Total <span>Rp. {{ number_format($item->subtotal) }}</span></a></li>
                        </ul>
                        @php $product_quantity = $item->quantity;  @endphp
                     @endforeach
                  </div>
               </div>
               <div class="col-lg-7">
                  <div class="order_box">
                     <h2 class="text-center">Transaction Details</h2>
                     <ul class="list">
                        <li><a href="#">Order Number <span>{{ $detail->reference }}</span></a></li>
                        <li><a href="#">Payment Method <span>{{ $detail->payment_method }}</span></a></li>
                        <li id="status"><a href="#">Payment Status <span class="@if($detail->status != 'PAID') badge bg-danger @else badge bg-success @endif text-white mt-3">{{ $detail->status }}</span></a></li>
                        <hr class="mt-2">
                        <input type="hidden" name="reference" value="{{ $detail->reference }}">
                        <a href="{{ $detail->checkout_url }}" target="_blank" class="primary-btn mt-4" style="width: 100%;border: none;" href="#">PAY</a>
                     </ul>
                  </div>
               </div>
               @if($detail->status == 'PAID')
               <div class="col-lg-12 mt-5">
                  <div class="order_box">
                     <h2 class="text-center">Your Item Details</h2>
                     @php
                        $items = getStock($id_product, $product_quantity, $detail->reference);
                     @endphp
                     <div class="trix-content">
                        @foreach($items as $item)
                           {!! $item !!}
                        @endforeach
                        {!! $transactionStock !!}
                     </div>
                     <hr class="mt-2">
                  </div>
               </div>
               @endif
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
<script type="text/javascript">
   setInterval(() => {
      $.ajax({  
         url: 'http://127.0.0.1:8000/api/transaction/'+$('input[name=reference]').val(),
         type: 'GET',  
         dataType: 'json',  
         success: function (data) {  
            if(data == 'PAID'){
               $('#status').html('<a href="#">Payment Status <span class="badge badge-success text-white mt-3">'+data+'</span></a>');
               $('#show-message').css('visibility', 'visible');
            }
            else {
               $('#status').html('<a href="#">Payment Status <span class="badge badge-danger text-white mt-3">'+data+'</span></a>');
            }
         },  
     });  
   }, 3000);
</script>
@endsection