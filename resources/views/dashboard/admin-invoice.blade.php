@extends('layouts.dashboard-app')

@section('content')
<div class="row">
  <div class="col-12">
    @if ($message = Session::get('success'))
    <div class="col-md-12">
        <div class="alert alert-success text-white" style="border: none;" role="alert">
          {{ $message }}
        </div>
    </div>
    @endif
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>All Unpaid Invoices</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-4">
          <table class="table align-items-center mb-0" id="table">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reference</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
                
               @foreach ($transactions as $invoice)
               <tr>
                  <td>
                    <div class="d-flex px-3 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $invoice->reference }}</p>
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="d-flex px-3 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $invoice->email }}</p>
                      </div>
                    </div>
                  </td>

                  <td>
                     <div class="d-flex px-3 py-1">
                       <div class="d-flex flex-column justify-content-center">
                         <p class="text-xs font-weight-bold mb-0">{{ $invoice->product->name }}</p>
                       </div>
                     </div>
                  </td>

                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $invoice->quantity }}</span>
                  </td>

                  <td class="align-middle text-center">
                     <span class="text-secondary text-xs font-weight-bold">Rp. {{ number_format($invoice->price) }}</span>
                  </td>

                  <td class="align-middle text-center">
                    <span class="badge badge-sm bg-gradient-danger">{{ $invoice->status }}</span>
                  </td>

                  <td class="align-middle d-flex">
                     <div class="col-md-2">
                       <a href="{{ route('admin.invoice.edit',$invoice->reference) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                         Edit
                       </a>
                     </div>
                     <div class="col-md-2">
                       <form method="post" action="{{ route('admin.invoice.delete', $invoice->reference) }}">@csrf<input type="hidden" name="_method" value="DELETE"><button style="background: none;border: none;" type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                         Delete
                       </button></form>
                     </div>
                  </td>
                </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $('#table').DataTable();
  });
</script>
@endsection