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
          <p class="mb-0 fw-bold">Edit Existing Category</p>
        </div>
      </div>
      <div class="card-body">
         <form action="{{ route('category_edit_store', $category->id) }}" method="post">
         @csrf
         <input type="hidden" name="_method" value="PUT">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                  <label class="form-control-label">Name</label>
                  <input class="form-control" type="text" value="{{ $category->name }}" name="name" autocomplete="off" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Badge Color</label>
                     <select name="color" class="form-control">
                        <option value="primary" @if($category->color == 'primary') selected @endif>Blue</option>
                        <option value="success" @if($category->color == 'success') selected @endif>Green</option>
                        <option value="warning" @if($category->color == 'warning') selected @endif>Orange</option>
                        <option value="danger" @if($category->color == 'danger') selected @endif>Red</option>
                        <option value="info" @if($category->color == 'info') selected @endif>Aqua</option>
                        <option value="secondary" @if($category->color == 'secondary') selected @endif>Gray</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                  <label class="form-control-label">Description</label>
                  <input class="form-control" type="text" name="description" value="{{ $category->description }}" autocomplete="off" required></input>
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