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
          <p class="mb-0 fw-bold">Add New Review</p>
        </div>
      </div>
      <div class="card-body">
         <form action="{{ route('review_new_store') }}" method="post" enctype="multipart/form-data">
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
                     <label>Star</label>
                     <select name="star" class="form-control">
							@for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                     @endfor
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="form-control-label">Description</label>
                     <input class="form-control" type="text" name="description" autocomplete="off" required>
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