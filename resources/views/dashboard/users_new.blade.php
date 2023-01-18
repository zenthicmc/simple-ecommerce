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
          <p class="mb-0 fw-bold">Create New User</p>
        </div>
      </div>
      <div class="card-body">
         <form action="{{ route('users_new_store') }}" method="post">
         @csrf
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                  <label class="form-control-label">Username</label>
                  <input class="form-control" type="text" name="name" autocomplete="off" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                  <label class="form-control-label">Email address</label>
                  <input class="form-control" type="email" name="email" autocomplete="off" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                  <label class="form-control-label">Password</label>
                  <input class="form-control" type="password" name="pwd" autocomplete="off" required>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                  <label class="form-control-label">Confirm Password</label>
                  <input class="form-control" type="password" name="pwd_cnfrm" autocomplete="off" required>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label>Role</label>
                  <select name="role" class="form-control">
                     <option value="admin" selected>Admin</option>
                  </select>
               </div>
            </div>
         <button type="submit" class="btn btn-primary btn-sm ms-auto mt-2 w-100 ">Create</button>
         </form>
      </div>
    </div>
  </div>
</div>
@endsection