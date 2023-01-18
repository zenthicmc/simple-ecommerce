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
          <p class="mb-0 fw-bold">Edit Purchase</p>
        </div>
      </div>
      <div class="card-body">
         <form action="{{ route('admin.purchase.edit_store', $transaction->reference) }}" method="post">
         @csrf
         <input type="hidden" name="_method" value="PUT">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="form-control-label">Reference</label>
                     <input class="form-control" value="{{ $transaction->reference }}" type="text" name="reference" autocomplete="off" readonly>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Status</label>
                     <select name="status" class="form-control">
                        <option value="UNPAID" @if($transaction->status == 'UNPAID') selected @endif>UNPAID</option>
                        <option value="PAID" @if($transaction->status == 'PAID') selected @endif>PAID</option>
                        <option value="CANCELED" @if($transaction->status == 'CANCELED') selected @endif>CANCELED</option>
                        <option value="EXPIRED" @if($transaction->status == 'EXPIRED') selected @endif>EXPIRED</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="form-control-label">Items</label>
                     <input id="stock" type="hidden" name="stock" value="{{ $transaction->stock }}">
                     <trix-editor input="stock"></trix-editor>
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