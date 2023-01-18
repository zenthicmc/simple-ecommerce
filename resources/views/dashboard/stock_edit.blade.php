@extends('layouts.dashboard-app')

@section('content')
<div class="row">
   @if ($errors->any())
   <div class="col-md-8">
      <div class="alert alert-danger text-white" style="border: none;" role="alert">
         @foreach ($errors->all() as $error)
            {{ $error }}
         @endforeach
      </div>
   </div>
   @endif
  <div class="col-md-8">
    <div class="card">
       <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0 fw-bold">Edit Existing Product</p>
        </div>
      </div>
      <div class="card-body">
         <form action="{{ route('stock_edit_store', $stock->code) }}" method="post">
         @csrf
         <input type="hidden" name="_method" value="PUT">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-control-label">Unlimited</label>
                     <select name="isUnlimited" class="form-control">
                        @if($stock->isUnlimited == 'true') 
                           <option value="true" selected>Yes</option>
                           <option value="false">No</option> 
                        @elseif($stock->isUnlimited == 'false') 
                           <option value="false" selected>No</option> 
                           <option value="true">Yes</option>
                        @endif
                     </select>
                     <div class="form-text">If Unlimited is enabled, stock can used repeatedly</div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Product</label>
                     <select name="id_product" class="form-control">
                     @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $stock->id_product == $product->id ? 'selected' : '' }}>{{ ucwords($product->name) }}</option>
                     @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="form-control-label">Expire At</label>
                     <input class="form-control" type="date" name="expire_at" value="{{ $stock->expire_at }}" autocomplete="off" required>
                     <div class="form-text">When stock is expired, stock will automatically deleted</div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="form-control-label">Content</label>
                     <input id="content" type="hidden" value="{{ $stock->content }}" name="content">
                     <trix-editor input="content"></trix-editor>
                     <div class="form-text">Content is used to deliver product details to buyers in text format</div>
                  </div>
               </div>     
            </div>
         <button type="submit" class="btn btn-primary btn-sm ms-auto mt-2 w-100 ">Update</button>
         </form>
      </div>
    </div>
  </div>
</div>
@endsection