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
         <form action="{{ route('product_edit_store', $product->id) }}" method="post" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="_method" value="PUT">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-control-label">Name</label>
                     <input class="form-control" value="{{ $product->name }}" type="text" name="name" autocomplete="off" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Category</label>
                     <select name="id_category" class="form-control">
                     @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->id_category == $category->id ? 'selected' : '' }}>{{ ucwords($category->name) }}</option>
                     @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-control-label">Price</label>
                     <input class="form-control" type="number" name="price" value="{{ $product->price }}" autocomplete="off" required>
                     <div class="form-text">Example: 50000, dont include formatting</div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-control-label">Image</label>
                     <input class="form-control" type="file" name="image" value="{{ $product->image }}" autocomplete="off">
                     <div class="form-text">Accepted Type: .png .jpg .svg | Recommended size: 512 x 512 px</div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="form-control-label">Description</label>
                        <input id="description" type="hidden" name="description" value="{{ $product->description }}">
                        <trix-editor input="description"></trix-editor>
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