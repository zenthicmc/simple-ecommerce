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
          <p class="mb-0 fw-bold">Create New Category</p>
        </div>
      </div>
      <div class="card-body">
         <form action="{{ route('category_new_store') }}" method="post">
         @csrf
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                  <label class="form-control-label">Name</label>
                  <input class="form-control" type="text" name="name" autocomplete="off" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Badge Color</label>
                     <select name="color" class="form-control">
                     <option value="primary" selected>Blue</option>
                     <option value="success">Green</option>
                     <option value="warning">Orange</option>
                     <option value="danger">Red</option>
                     <option value="info">Aqua</option>
                     <option value="secondary">Gray</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                  <label class="form-control-label">Description</label>
                  <input class="form-control" type="text" name="description" autocomplete="off" required></input>
                  </div>
               </div>     
            </div>
         <button type="submit" class="btn btn-primary btn-sm ms-auto mt-2 w-100 ">Create</button>
         </form>
      </div>
    </div>
  </div>
</div>
@endsection