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
          <p class="mb-0 fw-bold">Import Stock</p>
        </div>
      </div>
      <div class="card-body">
         <form action="{{ route('stock_import_store') }}" method="post" enctype="multipart/form-data">
         @csrf
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="form-control-label">File</label>
                     <input class="form-control" type="file" name="file" autocomplete="off" required>
										 <div class="form-text">File must be in .xlsx format</div>
                  </div>
               </div>
            </div>
         <button type="submit" class="btn btn-primary btn-sm ms-auto mt-2 w-100 ">Add</button>
         </form>
      </div>
    </div>
  </div>
</div>
@endsection