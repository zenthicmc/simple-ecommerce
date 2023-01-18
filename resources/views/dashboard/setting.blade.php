@extends('layouts.dashboard-app')

@section('content')
<div class="row">
    @if ($message = Session::get('success'))
      <div class="col-md-12">
          <div class="alert alert-success text-white" style="border: none;" role="alert">
            {{ $message }}
          </div>
      </div>
    @endif
    @if ($errors->any())
    <div class="col-md-12">
        <div class="alert alert-danger text-white" style="border: none;" role="alert">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </div>
    </div>
    @endif
   
   <div class="col-md-7">
      <div class="card">
         <div class="card-header pb-0">
            <div class="d-flex align-items-center">
               <p class="mb-0 fw-bold">General Settings</p>
            </div>
         </div>
         <div class="card-body">
            <form action="{{ route('setting_general_store') }}" method="post">
            @csrf
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-control-label">App Name</label>
                        <input class="form-control" type="text" value="{{ env('APP_NAME') }}" name="app_name" autocomplete="off" required>
                        <div class="form-text">Changes will be effected on all pages</div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-control-label">Whatsapp Link</label>
                        <input class="form-control" type="text" value="{{ env('WHATSAPP') }}" name="whatsapp" autocomplete="off" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-control-label">Discord Link</label>
                        <input class="form-control" type="text" value="{{ env('DISCORD') }}" name="discord" autocomplete="off" required>
                     </div>
                  </div>        
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-control-label">Instagram Link</label>
                        <input class="form-control" type="text" value="{{ env('INSTAGRAM') }}" name="instagram" autocomplete="off" required>
                     </div>
                  </div>      
               </div>
            <button type="submit" class="btn btn-primary btn-sm ms-auto mt-2 w-100 ">Update</button>
            </form>
         </div>
      </div>
   </div>
   <div class="col-md-5">
      <div class="card">
         <div class="card-header pb-0">
            <div class="d-flex align-items-center">
               <p class="mb-0 fw-bold">Database Settings</p>
            </div>
         </div>
         <div class="card-body">
            <form>
            @csrf
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-control-label">DB Host</label>
                        <input class="form-control" type="text" value="{{ env('DB_HOST') }}" name="db_host" autocomplete="off" readonly>
                        <div class="form-text">Change this on your .env file</div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-control-label">DB Username</label>
                        <input class="form-control" type="text" value="{{ env('DB_USERNAME') }}" name="db_username" autocomplete="off" readonly>
                        <div class="form-text">Change this on your .env file</div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label class="form-control-label">DB Database</label>
                        <input class="form-control" type="text" value="{{ env('DB_DATABASE') }}" name="db_database" autocomplete="off" readonly>
                        <div class="form-text">Change this on your .env file</div>
                     </div>
                  </div>          
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="col-md-7 mt-4">
      <div class="card">
         <div class="card-header pb-0">
            <div class="d-flex align-items-center">
               <p class="mb-0 fw-bold">Tripay Settings</p>
            </div>
         </div>
         <div class="card-body">
            <form action="{{ route('setting_tripay_store') }}" method="post">
            @csrf
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-control-label">Merchant Code</label>
                        <input class="form-control" type="text" value="{{ env('TRIPAY_MERCHANT_CODE') }}" name="merchant_code" autocomplete="off" required>
                        <div class="form-text">Get merchant code from tripay website</div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="form-control-label">Private Key</label>
                        <input class="form-control" id="private_key" type="password" value="{{ env('TRIPAY_PRIVATE_KEY') }}" name="private_key" autocomplete="off" required>
                        <input type="checkbox" onclick="showKey()">&nbsp;Show Key
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label class="form-control-label">Api Key</label>
                        <input class="form-control" type="text" value="{{ env('TRIPAY_API_KEY') }}" name="api_key" autocomplete="off" required>
                        <div class="form-text">Get api key from tripay website</div>
                     </div>
                  </div>            
               </div>
            <button type="submit" class="btn btn-primary btn-sm ms-auto mt-2 w-100 ">Update</button>
            </form>
         </div>
      </div>
   </div>
</div>
<script>
   function showKey() {
      var x = document.getElementById("private_key");
      if (x.type === "password") {
         x.type = "text";
      } else {
         x.type = "password";
      }
   }
</script>
@endsection