@extends('layouts.dashboard-app')

@section('content')
<div class="row">
    @if ($message = Session::get('success'))
      <div class="col-md-8">
          <div class="alert alert-success text-white" style="border: none;" role="alert">
            {{ $message }}
          </div>
      </div>
    @endif
    @if ($errors->any())
    <div class="col-md-8">
        <div class="alert alert-danger text-white" style="border: none;" role="alert">
          @foreach ($errors->all() as $error)
               {{ $error }}
          @endforeach
        </div>
    </div>
    @endif
   
   @if(empty($announcement))
   <div class="col-md-8 mb-3">
      <div class="card">
         <div class="card-body">
            <h4 class="text-center">You don't have any announcement</h4>
            <p class="text-center">You can create new announcement by filling the form</p>
         </div>
      </div>
   </div>
   @else
   <div class="col-md-8 mb-3">
      <div class="card">
         <div class="card-body">
            <h4 class="text-center">Your current announcement is: <div class="fst-italic">{{ $announcement->title }}</div></h4>
            <p class="text-center">Creating new announcement will overide the old one</p>
         </div>
      </div>
   </div>
   @endif

   <div class="col-md-8">
    <div class="card">
       <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0 fw-bold">Create Announcement</p>
        </div>
      </div>
      <div class="card-body">
         <form action="{{ route('announcement_store') }}" method="post">
         @csrf
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                  <label class="form-control-label">Title</label>
                  <input class="form-control" type="text" name="title" autocomplete="off" required>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                  <label class="form-control-label">Description</label>
                  <textarea class="form-control" style="min-height: 100px;" type="text" name="description" autocomplete="off" required></textarea>
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