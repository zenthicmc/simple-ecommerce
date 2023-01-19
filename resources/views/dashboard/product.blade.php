@extends('layouts.dashboard-app')

@section('content')
<div class="row">
  <div class="col-12">
    @if ($message = Session::get('success'))
    <div class="col-md-12">
        <div class="alert alert-success text-white" style="border: none;" role="alert">
          {{ $message }}
        </div>
    </div>
    @endif
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Products</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <a class="btn btn-primary" style="margin-left: 17px;font-size: 12px;" href="{{ route('product_new') }}">Create Product</a>
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                <th class="text-secondary opacity-7"></th>
					 <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
                
               @foreach ($products as $product)
               <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset('product-images/' . $product->image) }}" class="avatar avatar-sm me-3" alt="{{ $product->image }}">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $product->name }}</p>
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="d-flex px-3 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <span style="font-size: 10px;" class="badge badge-sm bg-gradient-{{ $product->category->color }}">{{ $product->category->name }}</span>
                      </div>
                    </div>
                  </td>

                  @php
                    $description = filter_var($product->description,FILTER_SANITIZE_STRING);

                    if(strlen($description) >= 40) {
                      $description = substr($description, 0, 40). '...';
                    }
                  @endphp

                  <td class="align-middle text-center">
                     <span class="text-secondary text-xs font-weight-bold">{{ $description }}</span>
                  </td>

                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">Rp. {{ number_format($product->price) }}</span>
                  </td>

                  <td class="align-middle text-center">
                  	<span class="text-secondary text-xs font-weight-bold">{{ countStockByIdProduct($product->id) }}</span>
                  </td>
						 <td class="align-middle">
                    <div class="col-md-2">
                     	<a href="{{ route('detail',$product->slug) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
									<span class="badge bg-success">
										<i class="fa-solid fa-eye me-1"></i>
										View
									</span>
                     	</a>
                    </div>
						</td>
                  <td class="align-middle">
                    <div class="col-md-2">
                     	<a href="{{ route('product_edit',$product->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
									<span class="badge bg-warning">
										<i class="fa-solid fa-pen me-1"></i>
										Edit
									</span>
                     	</a>
                    </div>
                    <div class="col-md-2 p-0">
								<form method="post" action="{{ route('product_delete', $product->id) }}">@csrf<input type="hidden" name="_method" value="DELETE"><button style="background: none;border: none;" type="submit" class="text-secondary font-weight-bold text-xs m-0 p-0">
									<span class="badge bg-danger">
										<i class="fa-solid fa-trash me-1"></i>
										Delete
									</span>
								</button></form>
                    </div>
                  </td>
                </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection